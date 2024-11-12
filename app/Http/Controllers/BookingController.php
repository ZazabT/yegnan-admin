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
                                 })->exists();
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
                        'guest_count' => $request->guest_count,
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
    public function getHostBookings($id)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }
    
        try {
            $bookings = Booking::with(['listing.item_images', 'guest.user' ])
                ->whereHas('listing', function ($query) use ($id) {
                    $query->where('host_id', $id);
                })
                ->get();
    
            return response()->json([
                'status' => 200,
                'message' => 'Bookings retrieved successfully',
                'bookings' => $bookings
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve bookings',
                'error' => 'Failed to retrieve bookings ' . $th->getMessage()
            ], 500);
        }
    }
    
    


    // get bookings for specific guest
    public function getGuestBookings($id){

        // check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }
         
        // try to get all bookings for the guest with there listings and host
        try {
            $bookings = Booking::with(['listing.item_images', 'guest.user' , 'listing.host.user'])->where('guest_id', $id)->get();
            return response()->json([
                'status' => 200,
                'message' => 'Bookings retrieved successfully',
                'bookings' => $bookings
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve bookings',
                'error' => 'Failed to retrieve bookings ' . $th->getMessage() ], 500);
        }
    }




    // get a booking by id
    public function getBookingbyId($id){

        // check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }

        // try to get booking by id
        try {
            $booking = Booking::with(['listing.item_images', 'guest.user' , 'listing.host.user'])->where('id', $id)->first();
            return response()->json([
                'status' => 200,
                'message' => 'Booking retrieved successfully',
                'booking' => $booking
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve booking',
                'error' => 'Failed to retrieve booking ' . $th->getMessage() ], 500);
        }
    }

      // accept a booking 
      public function acceptBooking($id)
      {
          DB::beginTransaction();
      
          try {
              $booking = Booking::where('id', $id)->first();
              if (!$booking) {
                  return response()->json(['status' => 404, 'message' => 'Booking not found or not pending'], 404);
              }
      
              $listingId = $booking->listing_id;
              $checkinDate = $booking->checkin_date;
              $checkoutDate = $booking->checkout_date;
      
              $conflictingAcceptedBooking = Booking::where('listing_id', $listingId)
                  ->where('status', 'accepted')
                  ->where(function ($query) use ($checkinDate, $checkoutDate) {
                      $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                          ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                          ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                              $query->where('checkin_date', '<=', $checkinDate)
                                    ->where('checkout_date', '>=', $checkoutDate);
                          });
                  })->exists();
      
              if ($conflictingAcceptedBooking) {
                  return response()->json(['status' => 409, 'message' => 'Conflict with existing accepted booking. Cannot accept this booking.'], 409);
              }
      
              $booking->status = 'accepted';
              $booking->save();
      
              Booking::where('listing_id', $listingId)
                  ->where('status', 'pending')
                  ->where(function ($query) use ($checkinDate, $checkoutDate) {
                      $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                          ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                          ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                              $query->where('checkin_date', '<=', $checkinDate)
                                    ->where('checkout_date', '>=', $checkoutDate);
                          });
                  })->update(['status' => 'rejected']);
      
              $fullyBooked = $this->checkIfListingIsFullyBooked($listingId);
      
              if ($fullyBooked) {
                  Listing::where('id', $listingId)->update(['status' => 'soldout']);
              }
      
              DB::commit();
      
              $message = 'Booking accepted and conflicting pending bookings rejected.';
              if ($fullyBooked) {
                  $message .= ' Listing is now fully booked and marked as sold out.';
              }
      
              return response()->json(['status' => 200, 'message' => $message], 200);
      
          } catch (Exception $e) {
              DB::rollback();
              return response()->json(['status' => 500, 'message' => 'Error accepting booking', 'error' => $e->getMessage()], 500);
          }
      }





      /**
 * Check if all dates within a listing's availability period are fully booked.
 */
private function checkIfListingIsFullyBooked($listingId)
{
    $listing = Listing::findOrFail($listingId);

    // Check if there's any day within the available period without a booking
    $unbookedDatesExist = Booking::where('listing_id', $listingId)
        ->where('status', 'accepted')
        ->where(function ($query) use ($listing) {
            // Get bookings that overlap any part of the listing's available range
            $query->where('checkin_date', '>', $listing->start_date)
                  ->orWhere('checkout_date', '<', $listing->end_date);
        })
        ->exists();

    // If no unbooked dates exist, mark as fully booked
    return !$unbookedDatesExist;
}






    // reject a booking
    public function rejectBooking($id) {
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized',
                'status' => 401
            ], 401);
        }

        // find the booking 
        $booking = Booking::where('id', $id)->first();
        if (!$booking) {
            return response()->json([
                'message' => 'Booking not found',
                'status' => 404
            ], 404);
        }

        // reject the booking
        $booking->status = 'rejected';
        $booking->save();
        return response()->json([
            'message' => 'Booking rejected',
            'status' => 200
        ], 200);
    } 

    
}








































