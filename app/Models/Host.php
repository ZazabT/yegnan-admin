<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Host extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    // Hidden fields
    protected $hidden = [
        'frontIdImage',
        'backIdImage',
    ];

    // Fillable fields
    protected $fillable = [
        'username',
        'hostDescription',
        'country',
        'region',
        'city',
        'phone_number',
        'facebook',
        'instagram',
        'tiktok',
        'telegram',
        'frontIdImage',
        'backIdImage',
        'isVerified',
        'profilePicture',
        'rating',
        'user_id'
    ];

    // Automatically set a 8-character unique ID when creating a new Host
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::random(8); // Generates an 8-character string
            }
        });
    }

    // Relations with User
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
