<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;


    // FILLABLE
    protected $fillable = [
     'host_describtion',
     'profile_picture',
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
