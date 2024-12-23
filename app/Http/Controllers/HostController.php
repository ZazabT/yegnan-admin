<?php

namespace App\Http\Controllers;
use Exception;
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
        // first check if the user is logged in
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
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'telegram' => ['nullable', 'string', 'max:255'],
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
        } catch (\Exception $e) {
            // Handle any exceptions and return error response
            return response()->json([
                'status' => 500,
                'error' => 'Host creation failed: ' . $e->getMessage(),
                'message' => 'Host creation failed'
            ], 500);
        }
    }

    // Get host profile 
    public function getHostProfile($id)
    {
        // first check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Try to get host profile with related user
        try {
            $host = Host::with(['user', 'listings.item_images', 'listings.categories', 'listings.bookings' ])
                        ->where('user_id', $id)
                        ->get();
            return response()->json([
                'status' => 200,
                'message' => 'Host profile retrieved successfully',
                'hostProfile' => $host
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve host profile',
                'error' => 'Failed to retrieve host profile ' . $th->getMessage()
            ], 500);
        }
    }

    // Update host profile
    public function updateHostProfile(Request $request, $id)
    {
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
                'error' => 'Failed to update host profile ' . $th->getMessage()
            ], 500);
        }
    }
}
