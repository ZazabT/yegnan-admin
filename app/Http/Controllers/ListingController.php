<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Item_Image;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Add listing
    public function store(Request $request)
    {
        try {
            // Ensure the user is authenticated
            if (!Auth::check()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'country' => 'required|string',
                'price_per_night' => 'required|numeric',
                'max_guest' => 'required|integer',
                'no_bed' => 'required|integer',
                'no_bath' => 'required|integer',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Create the listing
            $listing = Listing::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'price_per_night' => $request->price_per_night,
                'max_guest' => $request->max_guest,
                'no_bed' => $request->no_bed,
                'no_bath' => $request->no_bath,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            // Handle images
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName); // Save the image to the public/images directory

                    // Store image details in the Item_Image model
                    Item_Image::create([
                        'listing_id' => $listing->id,
                        'image_path' => 'images/' . $imageName,
                    ]);
                }
            }

            return response()->json(['message' => 'Listing created successfully!', 'listing' => $listing], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating listing', 'error' => $e->getMessage()], 500);
        }
    }
}
