<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    //Fillable
    protected $fillable =[
          'username',
          'profile_picture',
          'bio',
          'user_id'
    ];


    // Relations with user 
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Relation with bookings    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
