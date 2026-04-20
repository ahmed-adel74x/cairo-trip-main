<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ApiResponseTrait;

class BookingResource extends JsonResource
{
    use ApiResponseTrait;

    public function toArray(Request $request): array
    {
        $placeType     = $this->getPlaceType();
        $depositAmount = $this->getDepositAmount();

        return [
            'id'           => $this->id,
            'place'        => [
                'id'        => $this->place->id,
                'name'      => [
                    'ar' => $this->place->name_ar,
                    'en' => $this->place->name_en,
                ],
                'image_url' => asset($this->place->image_url),
                'location'  => [
                    'ar' => $this->place->location_ar,
                    'en' => $this->place->location_en,
                ],
            ],
            'booking_date'       => $this->booking_date->format('Y-m-d'),
            'person_count'       => $this->person_count,
            'total_price'        => [
                'ar' => $this->total_price_ar,
                'en' => $this->total_price_en,
            ],
            'total_price_number' => $this->total_price_number,
            'status'             => $this->status,
            'status_label'       => $this->getStatusLabel($this->status),

            // ── Payment Info ──────────────────────────────
            'place_type'         => $placeType,
            'place_type_label'   => $this->getPlaceTypeLabel($placeType),
            'deposit_amount'     => $depositAmount,
            'deposit_info'       => $this->buildDepositInfo($placeType, $depositAmount),
            'payment_status'     => $this->payment_status,
            'payment_status_label' => $this->getPaymentStatusLabel($this->payment_status),
            'amount_paid'        => $this->amount_paid,
            'remaining_amount'   => max(0, $this->total_price_number - $this->amount_paid),

            'created_at'         => $this->created_at->toISOString(),
        ];
    }

    // ── Helpers ───────────────────────────────────────

    private function getPlaceTypeLabel(string $placeType): array
    {
        return match($placeType) {
            'landmark'   => ['ar' => 'معلم سياحي', 'en' => 'Landmark'],
            'hotel'      => ['ar' => 'فندق',        'en' => 'Hotel'],
            'restaurant' => ['ar' => 'مطعم',        'en' => 'Restaurant'],
            default      => ['ar' => 'أخرى',        'en' => 'Other'],
        };
    }

    private function getPaymentStatusLabel(?string $status): array
    {
        return match($status) {
            'unpaid'        => ['ar' => 'غير مدفوع',       'en' => 'Unpaid'],
            'deposit_paid'  => ['ar' => 'تم دفع العربون',  'en' => 'Deposit Paid'],
            'fully_paid'    => ['ar' => 'مدفوع بالكامل',   'en' => 'Fully Paid'],
            default         => ['ar' => 'غير مدفوع',       'en' => 'Unpaid'],
        };
    }

    private function buildDepositInfo(string $placeType, float $depositAmount): array
    {
        if ($placeType === 'landmark') {
            return [
                'required' => false,
                'amount'   => 0.0,
                'note'     => [
                    'ar' => 'لا يلزم دفع عربون، يتم الدفع الكامل عند الزيارة',
                    'en' => 'No deposit required, full payment on visit',
                ],
            ];
        }

        return [
            'required'    => true,
            'amount'      => $depositAmount,
            'percentage'  => 20,
            'amount_ar'   => number_format($depositAmount, 0) . ' جنيه',
            'amount_en'   => number_format($depositAmount, 0) . ' EGP',
            'note'        => [
                'ar' => 'مطلوب دفع عربون 20% لتأكيد الحجز',
                'en' => 'A 20% deposit is required to confirm the booking',
            ],
        ];
    }
}