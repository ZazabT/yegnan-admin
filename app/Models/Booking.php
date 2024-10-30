<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'listing_id',
        'guest_id',
        'checkin_date',
        'checkout_date',
        'total_price',
        'status',
        'payment_status',
        'guest_count',
    ];

    // Relationships with guests
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    // Relationships with listings
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    
}
