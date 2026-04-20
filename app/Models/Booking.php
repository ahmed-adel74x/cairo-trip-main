<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'place_id',
        'booking_date',
        'person_count',
        'total_price_ar',
        'total_price_en',
        'total_price_number',
        'status',
        'payment_method',
        'amount_paid',
        'payment_status',
    ];

    protected $casts = [
        'booking_date'       => 'date',
        'total_price_number' => 'float',
        'amount_paid'        => 'float',
    ];

    // ── Relationships ──────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function trip()
    {
        return $this->hasOne(Trip::class);
    }

    // ── Scopes ─────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }

    // ── Helpers ────────────────────────────────────────

    /**
     * category → place_type label
     */
    public function getPlaceType(): string
    {
        return match($this->place->category ?? 'attraction') {
            'attraction' => 'landmark',
            'hotel'      => 'hotel',
            'restaurant' => 'restaurant',
            default      => 'landmark',
        };
    }

    /**
     * احسب الـ deposit
     * landmark   → 0.0
     * hotel      → 20% من total_price_number
     * restaurant → 20% من total_price_number
     */
    public function getDepositAmount(): float
    {
        $placeType = $this->getPlaceType();

        return match($placeType) {
            'landmark'   => 0.0,
            'hotel'      => round($this->total_price_number * 0.20, 2),
            'restaurant' => round($this->total_price_number * 0.20, 2),
            default      => 0.0,
        };
    }
}