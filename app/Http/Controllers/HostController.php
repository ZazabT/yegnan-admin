<?php

namespace App\Http\Controllers;

use App\Models\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HostController extends Controller
{
    // Create Host
    public function createHost(Request $request)
    {
        // Validate request data
        $validatedHost = $request->validate([
            'host_describtion' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048']
        ]);

        // Set the user ID from the authenticated user
        $validatedHost['user_id'] = Auth::user()->id;

        // Check if the request contains a profile picture
        if ($request->hasFile('profile_picture')) {
            // Store the uploaded image in a specific folder and get its path
            $imagePath = $request->file('profile_picture')->store('host_images', 'public');
            $validatedHost['profile_picture'] = $imagePath;
        }

        try {
            // Create the host record in the database
            $host = Host::create($validatedHost);
            $user = Auth::user();
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
                'error' => 'Host creation failed: ' . $e->getMessage()
            ], 500);
        }
    }


}
