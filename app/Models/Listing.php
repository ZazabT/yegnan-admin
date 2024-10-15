<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //Filable
    protected $fillable = [
        'title',
        'describtion',
        'address',
        'city',
        'state',
        'country',
        'price_per_night',
        'max_guest',
        'no_bed',
        'no_bath',
        'confirmed',
        'start_date',
        'end_date',
    ];

    //Relation with Category
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_listing');
    }

    //Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with images
    public function item_images()
    {
        return $this->hasMany(Item_Image::class);
    }
}
