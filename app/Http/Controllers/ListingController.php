<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Item_Image;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{

    // middleware
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['getAllListings', 'getListing']);
    }


    // Add listing
    public function create(Request $request)
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
                'price_per_night' => 'required|numeric',
                'max_guest' => 'required|integer',
                'bedroom' => 'required|integer',
                'bathroom' => 'required|integer',
                'bed' => 'required|integer',
                'rules' => 'required|string',
                'start_date' => 'required|date|after:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location_id' => 'required|integer',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            ]);
             // logged in user 
             $user = Auth::user();
            // Create the listing
             $listing = Listing::create([
                'title' => $request->title,
                'description' => $request->description,
                'price_per_night' => $request->price_per_night,
                'max_guest' => $request->max_guest,
                'bedroom' => $request->bedroom,
                'bathroom' => $request->bathroom,
                'bed' => $request->bed,
                'rules' => $request->rules,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'host_id' => $user->host->id,
                'location_id' => $request->location_id,
             ]);

            // Handle images
            if ($request->hasfile('images')) {
                 $isMain = true;
                foreach ($request->file('images') as $image) {

                    $imageName = time() . '_' . $image->getClientOriginalName();
                    // Save the image to the storage/app/public/images directory
                    $imagePath = $image->storeAs('images', $imageName, 'public');
                     
                    // Store image details in the Item_Image model
                    Item_Image::create([
                        'listing_id' => $listing->id,
                        'image_url' => 'storage/' . $imagePath, 
                        'isMain' => $isMain,
                    ]);

                    $isMain = false;
                }
            }
               // Attach the selected categories
            if ($request->has('categories')) {
                $listing->categories()->attach($request->categories); 
            }
    
            return response()->json(['message' => 'Listing created successfully!', 'listing' => $listing], 201);


        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating listing', 'error' => $e->getMessage()], 500);
        }
    }


    public function getAllListings(){
        // Try to get all listings 
        try {
            // Fetch listings with related item_images where confirmed is 1
            $listing = Listing::with('item_images')->where('confirmed', 1)->get();
            
            // Return the listings as a JSON response
            return response()->json($listing);
        } catch (\Throwable $th) {

            // Return an error response
            return response()->json(['error' => 'Failed to retrieve listings'], 500);
        }
    }
    
}
