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
                return response()->json([
                    'status' => 401,
                    'message' => 'User not authenticated',
                ], 401);
            }
    
            $validatedListing = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'price_per_night' => ['required', 'numeric'],
                'max_guest' => ['required', 'integer'],
                'no_bed' => ['required', 'integer'],
                'no_bath' => ['required', 'integer'],
                'start_date' => ['required', 'date', 'before:end_date'],
                'end_date' => ['required', 'date', 'after:start_date'],
                'images' => ['required', 'array'],
                'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:5048'], 
            ]);
            
    
            // Add logged-in user's ID
            $validatedListing['user_id'] = Auth::user()->id;
    
            // Create a listing
            $listing = Listing::create($validatedListing);
    
            // Handle the image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $path = $image->storeAs('listings', $imageName, 'public');
    
                    Item_Image::create([
                        'listing_id' => $listing->id,
                        'image_url' => $path,
                    ]);
                }
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'Listing created successfully',
                'listing' => $listing,
            ]);
    
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Listing creation failed',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }
    

    // Get all listings
    public function index()
    {
        $listings = Listing::all();
        return $listings;
    }
}
