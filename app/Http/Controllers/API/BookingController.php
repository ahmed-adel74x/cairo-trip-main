<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingPayRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Place;
use App\Models\Trip;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    use ApiResponseTrait;

    // ──────────────────────────────────────────────────
    // GET /api/bookings
    // ──────────────────────────────────────────────────
    public function index(Request $request): JsonResponse
    {
        $bookings = Booking::with('place')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return $this->successResponse(
            BookingResource::collection($bookings),
            'bookings_fetched',
            200
        );
    }

    // ──────────────────────────────────────────────────
    // POST /api/bookings
    // ──────────────────────────────────────────────────
    public function store(BookingRequest $request): JsonResponse
    {
        $user  = $request->user();
        $place = Place::active()->find($request->place_id);

        if (!$place) {
            return $this->errorResponse('place_not_found', 404);
        }

        // Check if user already has active booking for this place
        $existingBooking = Booking::where('user_id', $user->id)
            ->where('place_id', $place->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->first();

        if ($existingBooking) {
            return $this->errorResponse('already_booked', 422);
        }

        // Calculate total price
        $personCount      = $request->person_count;
        $totalPriceNumber = $place->price_number * $personCount;

        // Build bilingual price strings
        if ($place->is_free) {
            $totalPriceAr = 'مجاني';
            $totalPriceEn = 'Free';
        } else {
            $totalPriceAr = $totalPriceNumber . ' جنيه';
            $totalPriceEn = $totalPriceNumber . ' EGP';
        }

        // Create booking
        $booking = Booking::create([
            'user_id'            => $user->id,
            'place_id'           => $place->id,
            'booking_date'       => $request->booking_date,
            'person_count'       => $personCount,
            'total_price_ar'     => $totalPriceAr,
            'total_price_en'     => $totalPriceEn,
            'total_price_number' => $totalPriceNumber,
            'status'             => 'pending',
            'payment_status'     => 'unpaid',
            'amount_paid'        => 0,
        ]);

        // Create trip record linked to this booking
        Trip::create([
            'user_id'      => $user->id,
            'place_id'     => $place->id,
            'booking_id'   => $booking->id,
            'trip_date'    => $request->booking_date,
            'person_count' => $personCount,
            'price_ar'     => $totalPriceAr,
            'price_en'     => $totalPriceEn,
            'price_number' => $totalPriceNumber,
            'status'       => 'upcoming',
        ]);

        // Update counters
        $place->increment('total_bookings');
        $user->increment('trips_count');

        $booking->load('place');

        return $this->successResponse(
            new BookingResource($booking),
            'booking_created',
            201
        );
    }

    // ──────────────────────────────────────────────────
    // PUT /api/bookings/{id}/cancel
    // ──────────────────────────────────────────────────
    public function cancel(Request $request, int $id): JsonResponse
{
    $booking = Booking::with('place')
        ->where('user_id', $request->user()->id)
        ->find($id);

    if (!$booking) {
        return $this->errorResponse('booking_not_found', 404);
    }

    if (!in_array($booking->status, ['pending', 'confirmed'])) {
        return $this->errorResponse('booking_cannot_cancel', 422);
    }

    // ✅ حذف الـ Trip المرتبط
    Trip::where('booking_id', $booking->id)->delete();

    // ✅ تنقيص الـ counters
    if ($request->user()->trips_count > 0) {
        $request->user()->decrement('trips_count');
    }
    $booking->place()->decrement('total_bookings');

    // ✅ حذف الـ booking خالص
    $booking->delete();

    return $this->successResponse(
        null,
        'booking_cancelled',
        200
    );
}

    // ──────────────────────────────────────────────────
    // POST /api/bookings/{id}/pay
    // ──────────────────────────────────────────────────
    public function pay(BookingPayRequest $request, int $id): JsonResponse
    {
        $booking = Booking::with('place')
            ->where('user_id', $request->user()->id)
            ->find($id);

        if (!$booking) {
            return $this->errorResponse('booking_not_found', 404);
        }

        // لازم الـ booking يكون pending أو confirmed
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return $this->errorResponse('booking_cannot_pay', 422);
        }

        // لازم مش مدفوع بالكامل
        if ($booking->payment_status === 'fully_paid') {
            return $this->errorResponse('booking_already_paid', 422);
        }

        $amountPaid    = (float) $request->amount_paid;
        $totalPrice    = $booking->total_price_number;
        $depositAmount = $booking->getDepositAmount();
        $placeType     = $booking->getPlaceType();

        // ── التحقق من المبلغ المدفوع ──────────────────

        // للـ landmark مفيش deposit - لازم يدفع كامل
        if ($placeType === 'landmark') {
            if ($amountPaid < $totalPrice) {
                return $this->errorResponse('payment_insufficient_landmark', 422);
            }
        }

        // للـ hotel/restaurant - ممكن يدفع deposit أو كامل
        if (in_array($placeType, ['hotel', 'restaurant'])) {
            if ($amountPaid < $depositAmount && $amountPaid < $totalPrice) {
                return $this->errorResponse('payment_insufficient_deposit', 422);
            }
        }

        // ── تحديد الـ payment_status ──────────────────
        $newAmountPaid = $booking->amount_paid + $amountPaid;
        $newAmountPaid = min($newAmountPaid, $totalPrice); // مش يزيد عن التوتال

        if ($newAmountPaid >= $totalPrice) {
            $paymentStatus = 'fully_paid';
        } elseif ($newAmountPaid >= $depositAmount && $depositAmount > 0) {
            $paymentStatus = 'deposit_paid';
        } else {
            $paymentStatus = 'unpaid';
        }

        // ── تحديث الـ booking ─────────────────────────
        $booking->update([
            'payment_method' => $request->payment_method,
            'amount_paid'    => $newAmountPaid,
            'payment_status' => $paymentStatus,
            'status'         => 'confirmed', // تأكيد الحجز بعد الدفع
        ]);

        // تحديث الـ Trip كمان
        Trip::where('booking_id', $booking->id)
            ->update(['status' => 'upcoming']);

        $booking->load('place');

        return $this->successResponse(
            [
                'booking'        => new BookingResource($booking),
                'payment_detail' => [
                    'payment_method'   => $request->payment_method,
                    'amount_paid'      => $newAmountPaid,
                    'amount_paid_ar'   => number_format($newAmountPaid, 0) . ' جنيه',
                    'amount_paid_en'   => number_format($newAmountPaid, 0) . ' EGP',
                    'remaining'        => max(0, $totalPrice - $newAmountPaid),
                    'remaining_ar'     => number_format(max(0, $totalPrice - $newAmountPaid), 0) . ' جنيه',
                    'remaining_en'     => number_format(max(0, $totalPrice - $newAmountPaid), 0) . ' EGP',
                    'payment_status'   => $paymentStatus,
                    'is_fully_paid'    => $paymentStatus === 'fully_paid',
                ],
            ],
            'payment_confirmed',
            200
        );
    }
}