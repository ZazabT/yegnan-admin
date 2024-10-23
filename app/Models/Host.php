<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;


    // FILLABLE
    protected $fillable = [
     'username',
     'hostDescription',
     'country',
     'region',
     'city',
     'phone_number',
     'facebook',
     'instagram',
     'tiktoke',
     'telegram',
     'frontIdImage',
     'backIdImage',
     'isVerified',
     'profilePicture',
     'rating',
     'user_id'
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with Listings
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
