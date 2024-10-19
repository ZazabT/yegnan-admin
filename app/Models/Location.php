<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;


    // Fillable 
    protected $fillable = [
        'city',
        'region',
        'country',
    ];



    // Relation with Listing 
    public function listings()
    {
        return $this->belongsToMany(Listing::class);
    }
}
