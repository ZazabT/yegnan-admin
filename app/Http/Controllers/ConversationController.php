<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Messages;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    //Start a new conversation by saying Hello 

    public function sayHi(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'booking_id' => 'required|exists:bookings,id|integer',
                'host_id' => 'required|exists:hosts,id|string',
                'guest_id' => 'required|exists:guests,id|string',
            ]);
    
            // Find the booking and check if it exists
            $booking = Booking::where('id', $request->booking_id)->first();
            if (!$booking) {
                return response()->json([
                    'message' => 'Booking not found',
                    'status' => 404
                ], 404);
            }
    
            // Check if the booking has an existing conversation
            if ($booking->hasMessage) {
                return response()->json([
                    'message' => 'A conversation already exists for this booking.'
                ], 400);
            }
    
            // Create a new conversation
            $conversation = Conversation::create($validated);
    
            // Get the sender id
            $senderId = $request->user()->id;
    
            // Create the first "Hi" message from the logged-in user
            $message = Messages::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $senderId,
                'message' => 'Hi There',
            ]);
    
            // Update the booking to indicate it has a message
            $booking->update(['hasMessage' => true]);
    
            // Return the success response
            return response()->json([
                'status' => 200,
                'conversation' => $conversation,
                'message' => $message
            ], 200);
        } catch (\Exception $e) {
            // Handle any exception and return a generic error message
            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
    

    // fetch the user that have cconversation with this id 
    public function usersConversationWith($id)
    {
        try {
            // Get all conversations for this user
            $conversations = Conversation::where('host_id', $id)
                ->orWhere('guest_id', $id)
                ->with(['host.user', 'guest.user'])
                ->get();
    
            // Map conversations with the other user and conversation details
            $usersWithConversations = $conversations->map(function ($conversation) use ($id) {
                // Determine if the current user is the host or guest in this conversation
                $otherUser = $conversation->host_id === $id ? $conversation->guest : $conversation->host;
    
                return [
                    'user' => $otherUser,
                    'conversation' => $conversation
                ];
            });
    
            $usersWithConversations = $usersWithConversations->unique(function ($item) {
            return $item['user']->id . '-' . $item['conversation']->booking_id;
        });
    
            // Return the response
            return response()->json([
                'status' => 200,
                'users' => $usersWithConversations
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
    

    // Fetch a specific conversation by ID
    public function getConversationMessages($conversationId)
    {
          // Check if the conversation exists
        //   $conversation = Conversation::with(['host', 'guest'])->findOrFail($conversationId);

  
          // Fetch all messages for the conversation
          $messages = Messages::where('conversation_id', $conversationId)->orderBy('created_at', 'asc')->get();

          // send with the sender info if the sender is not the logged in user 
  
          return response()->json([
              'status' => 200,
              'messages' => $messages
          ]);
    }



}
