<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // reserve a listing 
    public function reserve(Request $request) {
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }
        // User  
        $user = Auth::user();
    
        // Validate request
        $request->validate([
            'checkin_date' => 'required|date|after_or_equal:date',
            'checkout_date' => 'required|date|after_or_equal:checkin_date',
            'total_price' => 'required|numeric',
            'listing_id' => 'required|exists:listings,id',
        ]);
    
        // Begin Transaction
    
        try {
            $booking = Booking::create([
                'guest_id' => $user->guest->id,
                'listing_id' => $request->listing_id,
                'checkin_date' => $request->checkin_date,  // Corrected
                'checkout_date' => $request->checkout_date, // Corrected
                'total_price' => $request->total_price,
            ]);
    
            // Commit the transaction
            DB::commit();
    
            return response()->json([
                'message' => 'Booking created successfully',
                'status' => 201
            ], 200);
        } catch (Exception $e) {
            // Rollback on error
            return response()->json([
                'status' => 500,
                'message' => 'Error creating listing',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    


    // get Bookings for all listing of the spesific host  
    public function getHostBookings($id){
    }


    // get bookings for specific guest
    public function getGuestBookings($id){
    }
}
