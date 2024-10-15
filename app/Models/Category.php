<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    // FILLABLE

    protected $fillable = [
        'name',
        'description',
        'icon',
    ];


    
    // RELATIONS

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'category_listing');
    }
}
