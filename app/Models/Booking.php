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
        'check_in',
        'check_out',
        'total_price',
        'status',
    ];

    // Relationships with guests
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    // Relationships with listings
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
