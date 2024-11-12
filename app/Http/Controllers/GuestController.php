<?php

namespace App\Http\Controllers;


use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    //getGuestProfile
    public function getGuestProfile($id){
         // first cheack if the user is logged in
         if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }


        // Try to get host profile with related user
        try {
            $guest = Guest::with(['user' ,'bookings.listing.item_images'])->where('user_id', $id)->get();
            return response()->json([
                'status' => 200,
                'message' => 'Host profile retrieved successfully',
                'guestProfile' => $guest
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve host profile',
                'error' => 'Failed to retrieve host profile ' . $th->getMessage() ], 500);
        }

    }
}
