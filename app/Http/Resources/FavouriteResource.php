<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'place'        => [
                'id'             => $this->place->id,
                'name'           => [
                    'ar' => $this->place->name_ar,
                    'en' => $this->place->name_en,
                ],
                'description'    => [
                    'ar' => $this->place->description_ar,
                    'en' => $this->place->description_en,
                ],
                'image_url'      => asset($this->place->image_url),
                'is_free'        => $this->place->is_free,
                'price'          => [
                    'ar' => $this->place->price_ar,
                    'en' => $this->place->price_en,
                ],
                'price_number'   => $this->place->price_number,
                'location'       => [
                    'ar' => $this->place->location_ar,
                    'en' => $this->place->location_en,
                ],
                // ✅ إضافة الـ coordinates
                'coordinates'    => [
                    'latitude'  => $this->place->latitude,
                    'longitude' => $this->place->longitude,
                ],
                'rating_avg'     => round($this->place->rating_avg, 1),
                'total_bookings' => $this->place->total_bookings,
                'category'       => $this->place->category,
                'category_label' => $this->getCategoryLabel($this->place->category),

                // ✅ إضافة is_booked
                'is_booked'      => $this->is_booked ?? false,
            ],
            'created_at'   => $this->created_at->toISOString(),
        ];
    }

    private function getCategoryLabel(?string $category): array
    {
        return match($category) {
            'attraction' => ['ar' => 'معلم سياحي', 'en' => 'Attraction'],
            'restaurant' => ['ar' => 'مطعم',        'en' => 'Restaurant'],
            'hotel'      => ['ar' => 'فندق',        'en' => 'Hotel'],
            default      => ['ar' => 'أخرى',        'en' => 'Other'],
        };
    }
}