<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_Image extends Model
{
    use HasFactory;

    //FILLABLE
    protected $fillable = [
        'listing_id',
        'image_url',
        'isMain'
    ];


    // Relation with Listing
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
