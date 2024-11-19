<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Fillables 
    protected $fillable = [
        'listing_id',
        'user_id'
    ];


    // Relation with listing
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }


    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
