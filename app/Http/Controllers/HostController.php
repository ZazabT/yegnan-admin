<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use DatePeriod;
use DateInterval;
use App\Models\Host;
use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HostController extends Controller
{
    // Create Host
    public function createHost(Request $request)
    {


        // first cheack if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }


        // Validate request data
        $validatedHost = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'hostDescription' => ['required', 'string'],
            'profilePicture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
            'country' => ['required' , 'string' , 'max:255'],
            'city' => ['required' , 'string' , 'max:255'],
            'region' =>['required' , 'string' , 'max:255'],
            'phone_number' => ['required' , 'string' , 'max:255'],
            'facebook' => ['nullable' , 'string' , 'max:255'],
            'instagram' => ['nullable' , 'string' , 'max:255'],
            'telegram' => ['nullable' , 'string' , 'max:255'],
            'frontIdImage' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
            'backIdImage' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
        ]);

        // Set the user ID from the authenticated user
       $validatedHost['user_id'] = Auth::user()->id;

        // Logged in user 
        $user = Auth::user();
        // Get the user's first name
        $userFirstName = $user->firstName; 

        // Check if the request contains a profile picture
if ($request->hasFile('profilePicture')) {
    // Create a unique image name based on the user's first name and current timestamp
    $imageName = $userFirstName . '_profile_' . time() . '.' . $request->file('profilePicture')->getClientOriginalExtension();
    
    // Store the uploaded image in the 'host_profile' directory in the 'public' folder
    $imagePath = $request->file('profilePicture')->move(public_path('host_profile'), $imageName);
    
    // Save the public path for storing in the database (relative to the public folder)
    $validatedHost['profilePicture'] = 'host_profile/' . $imageName; 
}

// Check if the request contains a front ID image
if ($request->hasFile('frontIdImage')) {
    // Create a unique image name for the front ID image
    $frontIdImageName = $userFirstName . '_frontId_' . time() . '.' . $request->file('frontIdImage')->getClientOriginalExtension();
    
    // Store the uploaded image in the 'host_Id_frontIdImage' directory in the 'public' folder
    $imagePath = $request->file('frontIdImage')->move(public_path('host_Id_frontIdImage'), $frontIdImageName);
    
    // Save the public path for storing in the database (relative to the public folder)
    $validatedHost['frontIdImage'] = 'host_Id_frontIdImage/' . $frontIdImageName; 
}

// Check if the request contains a back ID image
if ($request->hasFile('backIdImage')) {
    // Create a unique image name for the back ID image
    $backIdImageName = $userFirstName . '_backId_' . time() . '.' . $request->file('backIdImage')->getClientOriginalExtension();
    
    // Store the uploaded image in the 'host_Id_backIdImage' directory in the 'public' folder
    $imagePath = $request->file('backIdImage')->move(public_path('host_Id_backIdImage'), $backIdImageName);
    
    // Save the public path for storing in the database (relative to the public folder)
    $validatedHost['backIdImage'] = 'host_Id_backIdImage/' . $backIdImageName;
}

        

        try {
            // Create the host record in the database
            $host = Host::create($validatedHost);

            $user->isHomeOwner = true;
            $user->save();
         
            return response()->json([
                'status' => 201,
                'message' => 'Host created successfully',
                'Host' => $host
            ], 201);

            // make the user a host

        } catch (\Exception $e) {
            // Handle any exceptions and return error response
            return response()->json([
                'status' => 500,
                'error' => 'Host creation failed: ' . $e->getMessage(),
                'message' => 'Host creation failed'
            ], 500);
        }
    }


    // get host profile 
    public function getHostProfile($id){
       

        // first cheack if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }
        
         // Try to get host profile with related user
        try {
            $host = Host::with('user')->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Host profile retrieved successfully',
                'host' => $host
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve host profile',
                'error' => 'Failed to retrieve host profile ' . $th->getMessage() ], 500);
        }
    }



    // update host profile
    public function updateHostProfile(Request $request, $id){
        // get host profile
        $host = Host::find($id);

        // try to update host profile
        try {
            $host->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Host profile updated successfully',
                'host' => $host
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update host profile',
                'error' => 'Failed to update host profile ' . $th->getMessage() ], 500);
        } 
    }


    // accept a booking 
    public function acceptBooking($id)
{
    // Start a transaction to ensure data consistency
    DB::beginTransaction();

    try {
        // Find the booking to accept and ensure it’s pending
        $booking = Booking::where('id', $id)->where('status', 'pending')->first();
        if (!$booking) {
            return response()->json([
                'status' => 404,
                'message' => 'Booking not found or not pending',
            ], 404);
        }

        $listingId = $booking->listing_id;
        $checkinDate = $booking->checkin_date;
        $checkoutDate = $booking->checkout_date;

        // Check if there are any accepted bookings that overlap with this booking's dates
        $conflictingAcceptedBooking = Booking::where('listing_id', $listingId)
            ->where('status', 'accepted')
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                    ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                    ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                        $query->where('checkin_date', '<=', $checkinDate)
                              ->where('checkout_date', '>=', $checkoutDate);
                    });
            })
            ->exists();

        if ($conflictingAcceptedBooking) {
            return response()->json([
                'status' => 409,
                'message' => 'Conflict with existing accepted booking. Cannot accept this booking.',
            ], 409);
        }

        // Update the booking status to accepted
        $booking->status = 'accepted';
        $booking->save();

        // Reject any pending bookings that overlap with this booking's dates
        Booking::where('listing_id', $listingId)
            ->where('status', 'pending')
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
                    ->orWhereBetween('checkout_date', [$checkinDate, $checkoutDate])
                    ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                        $query->where('checkin_date', '<=', $checkinDate)
                              ->where('checkout_date', '>=', $checkoutDate);
                    });
            })
            ->update(['status' => 'rejected']);

        // Check if all dates in the listing's availability period are now fully booked
        $fullyBooked = $this->checkIfListingIsFullyBooked($listingId);

        // Update listing status if fully booked
        if ($fullyBooked) {
            Listing::where('id', $listingId)->update(['status' => 'soldout']);
        }

        // Commit the transaction
        DB::commit();

        return response()->json([
            'status' => 200,
            'message' => 'Booking accepted and conflicting pending bookings rejected.',
        ], 200);
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollback();
        return response()->json([
            'status' => 500,
            'message' => 'Error accepting booking',
            'error' => $e->getMessage()
        ], 500);
    }
}

/**
 * Check if all dates within a listing's availability period are fully booked.
 */
private function checkIfListingIsFullyBooked($listingId)
{
    $listing = Listing::findOrFail($listingId);

    // Get all dates within the listing's available range
    $availableDates = new DatePeriod(
        new DateTime($listing->start_date),
        new DateInterval('P1D'),
        new DateTime($listing->end_date . ' +1 day')
    );

    // Loop through each date and check if there's an accepted booking covering that date
    foreach ($availableDates as $date) {
        $dateString = $date->format('Y-m-d');
        $isDateBooked = Booking::where('listing_id', $listingId)
            ->where('status', 'accepted')
            ->where('checkin_date', '<=', $dateString)
            ->where('checkout_date', '>=', $dateString)
            ->exists();

        // If any date is not booked, return false
        if (!$isDateBooked) {
            return false;
        }
    }

    return true;
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
