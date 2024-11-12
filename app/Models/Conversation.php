<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;


    // Fillable
    protected $fillable = [
        'booking_id',
        'guest_id',
        'host_id',
        'is_open',
    ];



    // Relationships

                // Relationships with guests
                public function guest()
                {
                    return $this->belongsTo(Guest::class);
                }


                // Relationships with hosts
                public function host()
                {
                    return $this->belongsTo(Host::class);
                }

                // Relationships with Messages
                public function messages()
                {
                    return $this->hasMany(Messages::class);
                }

                // Relationships with Bookings
              

}

