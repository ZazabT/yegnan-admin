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
        'description',
        'price_per_night',
        'max_guest',
        'bedrooms',
        'bathrooms',
        'beds',
        'rules',
        'confirmed',
        'start_date',
        'end_date',
        'host_id',
        'category_id',
        'location_id',
    ];

    //Relation with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_listings');
    }

    //Relation with host
    public function host(){
        
        return $this->belongsTo(Host::class);
    }

    // Relation with images
    public function item_images()
    {
        return $this->hasMany(Item_Image::class);
    }

    // Relation with bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    // Relation with Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }




    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

}
