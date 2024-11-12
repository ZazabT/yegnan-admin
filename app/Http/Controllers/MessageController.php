<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Conversation;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // send message
    public function sendMessage(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'conversation_id' => 'required|exists:conversations,id|integer',
                'sender_id' => 'required|exists:users,id|integer',
                'message' => 'required|string'
            ]);
    
            // Create a new message
            $message = Messages::create($validated);
    
            // Return success response
            return response()->json([
                'status' => 200,
                'message' => $message
            ], 200);
    
        
        } catch (\Exception $e) {
            // Catch any other exceptions
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while sending the message.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    


    // edit message


    // delete message
}
