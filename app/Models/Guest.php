<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    // Fillable fields
    protected $fillable = [
        'username',
        'profile_picture',
        'bio',
        'user_id'
    ];

    // Automatically set a 8-character unique ID when creating a new Guest
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

    // Relation with Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
