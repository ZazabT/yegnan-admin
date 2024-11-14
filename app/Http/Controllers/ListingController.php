<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Item_Image;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller ;

class ListingController extends Controller
{

    // The constructor
    // public function __construct()
    // {
    //     // Ensure middleware is applied correctly
    //     $this->middleware('auth:sanctum')->except(['getAllListings', 'getListing']);
    // }


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
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer', 
                'beds' => 'required|integer',
                'rules' => 'required|string',
                'start_date' => 'required|date|after:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location_id' => 'required|integer',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10024|nullable',
                'categories' => 'array|nullable',
                'categories.*' => 'integer|exists:categories,id',
            ]);
    
            // Begin Transaction
            DB::beginTransaction();
            
            // logged in user 
            $user = Auth::user();
            // Create the listing
            $listing = Listing::create([
                'title' => $request->title,
                'description' => $request->description,
                'price_per_night' => $request->price_per_night,
                'max_guest' => $request->max_guest,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'beds' => $request->beds,
                'rules' => $request->rules,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'host_id' => $user->host->id,
                'location_id' => $request->location_id,
            ]);
    
            // Handle images
            if ($request->hasfile('images')) {
                $isMain = true;
                $listingName = $listing->title . ' - ';
                foreach ($request->file('images') as $image) {
                    $imageName =$listingName . time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('liisting_images'), $imageName);
                    $image_url = 'liisting_images/' . $imageName;
                    // Store image details in the Item_Image model
                    Item_Image::create([
                        'listing_id' => $listing->id,
                        'image_url' => $image_url, 
                        'isMain' => $isMain,
                    ]);
    
                    $isMain = false;
                }
            }
    
            // Attach the selected categories
            if ($request->has('categories')) {
                $listing->categories()->attach($request->categories); 
            }
    
            // Commit Transaction
            DB::commit();
     
            return response()->json([
                'status' => 201,
                'message' => 'Listing created successfully!', 'listing' => $listing], 201);
    
        } catch (Exception $e) {
            // Rollback on error
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error creating listing', 'error' => $e->getMessage()], 500);
        }
    }
    
    // get all listing 
    public function getAllListings(){
        // Try to get all listings 
        try {
            // Fetch listings with related item_images where confirmed is 1
            $listing = Listing::with(['item_images' , 'categories' , 'location' , 'host.user'])->where('confirmed', 1)->get();
            
            // Return the listings as a JSON response
            return response()->json([
                'status' => 200,
                'listings' => $listing],200);
        } catch (\Throwable $th) {

            // Return an error response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve listings',
                'error' => 'Failed to retrieve listings'], 500);
        }
    }

    // get listing by id
    public function getListing($id){
         try {
            // Fetch listings with related item_images , host  location ...
            $listing = Listing::with(['item_images' , 'categories' , 'location' , 'host.user' , 'bookings'])->find($id);

            // Return the listings as a JSON response
            return response()->json([
                'status' => 200,
                'message' => 'Listing retrieved successfully!',
                'listing' => $listing],200);
         } catch (\Throwable $th) {
            // Return an error response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve listings',
                'error' => 'Failed to retrieve listings ' . $th->getMessage() ], 500);
        }
    }

    // update listing
    public function updateListing(Request $request, $id)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }
    
        // Find the listing by id and return 404 if not found
        $listing = Listing::find($id);
        if (!$listing) {
            return response()->json([
                'status' => 404,
                'message' => 'Listing not found with this id: ' . $id
            ], 404);
        }
    
        // Check if there are bookings for this listing, and prevent updates if any exist
        if ($listing->bookings()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => "This listing has bookings and cannot be updated."
            ], 400);
        }
    
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price_per_night' => 'required|numeric',
                'max_guest' => 'required|integer',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'beds' => 'required|integer',
                'rules' => 'required|string',
                'start_date' => 'required|date|after:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location_id' => 'required|integer',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10024|nullable',
                'categories' => 'array|nullable',
                'categories.*' => 'integer|exists:categories,id',
            ]);
    
            // Update the listing
            $listing->update([
                'title' => $request->title,
                'description' => $request->description,
                'price_per_night' => $request->price_per_night,
                'max_guest' => $request->max_guest,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'beds' => $request->beds,
                'rules' => $request->rules,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'location_id' => $request->location_id,
            ]);
    
            // Handle images if any are provided
            if ($request->hasfile('images')) {
                $listingName = $listing->title . ' - ';
                $isMain = true; // Set the first image as the main one
    
                foreach ($request->file('images') as $image) {
                    $imageName = $listingName . time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('listing_images'), $imageName);
                    $image_url = 'listing_images/' . $imageName;
    
                    // Store image details in the Item_Image model
                    Item_Image::create([
                        'listing_id' => $listing->id,
                        'image_url' => $image_url,
                        'isMain' => $isMain,
                    ]);
    
                    // Set the next images as non-main
                    $isMain = false;
                }
            }
    
            // Attach the selected categories if provided
            if ($request->has('categories')) {
                $listing->categories()->sync($request->categories); // Use sync() instead of attach to update categories
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'Listing updated successfully.'
            ], 200);
    
        } catch (\Throwable $th) {
            // Return 500 error if the update fails
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update listing',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    // delete listing
     public function deleteListing($id){

         // cheack if the user is logged in
         if(!Auth::check()){
            return response()->json([
               'status'=> 401,
               'message' => 'Unauthorized',
            ], 401); 
         }


         // get the listing by id if not found return 404
         $listing = Listing::find($id);
         if(!$listing){
            return response()->json([
               'status'=> 404,
               'message' => 'Listing not found',
            ], 404); 
         }

         // check the listing is there is any booking 
         if($listing->bookings()->exists()){
            return response()->json([
               'status'=> 400,
               'error' => 'This listing has bookings and cannot be Deleted.'
            ] , 400);
         }

         try{
            // try to delete the listing 
            $listing->delete();

            // return 200
            return response()->json([
               'status'=> 200,
               'message' => 'Listing deleted successfully',
            ], 200);
            
         }catch(\Throwable $th){
            // return 500
            return response()->json([
               'status'=> 500,
               'message' => 'Failed to delete listing',
               'error' => $th->getMessage()
            ], 500);

        }
     }


    // reHost listing
    public function reHostListing($id){
        
    }
    
    
}
