<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'firstName',
       'lastName',
       'email',
       'password',
       'isHomeOwner',
       'age',  
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Relation with Listings
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    //Relation with Host
    public function host()
    {
        return $this->hasOne(Host::class);
    }

    // Relation with Guest
    public function guest()
    {
        return $this->hasOne(Guest::class);
    }


    // Relation with conversationsAsaHost
    public function conversationsAsHost()
    {
        return $this->hasMany(Conversation::class, 'host_id');
    }

    // Relation with conversationsAsGuest
    public function conversationsAsGuest()
    {
        return $this->hasMany(Conversation::class, 'guest_id');
    }

    // Relation with messages
    public function messages()
    {
        return $this->hasMany(Messages::class , 'sender_id');
    } 

    // Relation with likes 
    public function likedListings()
    {
        return $this->belongsToMany(Listing::class, 'likes')->withTimestamps();
    }
}
