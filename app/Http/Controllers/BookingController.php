<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Booking;
use App\Models\Listing;
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
            'guest_count' => 'required|integer',
        ]);

        $listingId= $request->listing_id;
        $checkinDate = $request->checkin_date;
        $checkoutDate = $request->checkout_date;

           // Check if the requested dates are within the listing's start and end dates
           $listing = Listing::where('id', $listingId)
           ->where('start_date', '<=', $checkinDate)
           ->where('end_date', '>=', $checkoutDate)
           ->first();
    
           if (!$listing) {
               return response()->json([
                   'message' => 'Listing not found or dates are outside the listing\'s start and end dates',
                   'status' => 404
               ], 404);
           }

             // Check for conflicting bookings within the requested date range that are accepted
             $conflictingBookings = Booking::where('listing_id', $listingId)
                                 ->where('status', 'accepted')
                                 ->where(function ($query) use ($checkinDate, $checkoutDate) {
                                    $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                                    ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                                    ->orWhere(function($query) use ($checkinDate, $checkoutDate) {
                                        $query->where('checkin_date', '<=', $checkinDate)
                                              ->where('checkout_date', '>=', $checkoutDate);
                                    });
                                 })->exits();
             if ($conflictingBookings) {
                 return response()->json([
                     'message' => 'Conflicting bookings found',
                     'status' => 409
                 ], 409);
             }

               // Begin Transaction
                DB::beginTransaction();
                try {
                    $booking = Booking::create([
                        'guest_id' => $user->guest->id,
                        'listing_id' => $listingId,
                        'checkin_date' => $checkinDate,
                        'checkout_date' => $checkoutDate,
                        'total_price' => $request->total_price,
                    ]);

                    // Commit the transaction
                    DB::commit();

                    return response()->json([
                        'message' => 'Booking created successfully',
                        'status' => 201,
                        'booking' => $booking
                    ], 201);
                } catch (Exception $e) {
                    // Rollback on error
                    DB::rollback();
                    return response()->json([
                        'status' => 500,
                        'message' => 'Error creating booking',
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
