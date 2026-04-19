<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavouriteResource;
use App\Models\Favourite;
use App\Models\Place;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    use ApiResponseTrait;

    // ──────────────────────────────────────────────────
    // GET /api/favourites
    // ──────────────────────────────────────────────────
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $favourites = Favourite::with('place')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        // ✅ جيب الـ booked place IDs بـ query واحدة
        $bookedPlaceIds = $user->bookings()
            ->whereIn('status', ['pending', 'confirmed'])
            ->pluck('place_id')
            ->toArray();

        // ✅ ضيف is_booked لكل favourite
        $favourites->each(function ($favourite) use ($bookedPlaceIds) {
            $favourite->is_booked = in_array($favourite->place_id, $bookedPlaceIds);
        });

        return $this->successResponse(
            FavouriteResource::collection($favourites),
            'favourites_fetched',
            200
        );
    }

    // ──────────────────────────────────────────────────
    // POST /api/favourites/{place_id}/toggle
    // ──────────────────────────────────────────────────
    public function toggle(Request $request, int $placeId): JsonResponse
    {
        $user = $request->user();

        $place = Place::active()->find($placeId);
        if (!$place) {
            return $this->errorResponse('place_not_found', 404);
        }

        $favourite = Favourite::where('user_id', $user->id)
            ->where('place_id', $placeId)
            ->first();

        if ($favourite) {
            // Remove from favourites
            $favourite->delete();

            if ($user->favourites_count > 0) {
                $user->decrement('favourites_count');
            }

            return $this->successResponse(
                [
                    'place_id'     => $placeId,
                    'is_favourite' => false,
                ],
                'favourite_removed',
                200
            );
        }

        // Add to favourites
        Favourite::create([
            'user_id'  => $user->id,
            'place_id' => $placeId,
        ]);

        $user->increment('favourites_count');

        return $this->successResponse(
            [
                'place_id'     => $placeId,
                'is_favourite' => true,
            ],
            'favourite_added',
            200
        );
    }
}