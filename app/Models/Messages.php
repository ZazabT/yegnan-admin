<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'message',
        'conversation_id',
        'is_read',
        'sender_id',
    ];

    // Relations
               

               // Relation with conversations
               public function conversation()
               {
                   return $this->belongsTo(Conversation::class);
               }

               // Relation with users
               public function sender()
               {
                   return $this->belongsTo(User::class);
               }
}
