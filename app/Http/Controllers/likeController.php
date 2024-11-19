<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Toggle like/unlike for a listing by the authenticated user.
     */
    public function like(Request $request, $listingId)
    {
        $user = Auth::user(); // Get the logged-in user

        // Validate that the listing exists
        $listing = Listing::findOrFail($listingId); 

        // Check if the user has already liked the listing
        if ($user->likedListings->contains($listing)) {
            $user->likedListings()->detach($listing); // Remove the like
            $liked = false;
        } else {
            $user->likedListings()->attach($listing); // Add the like
            $liked = true;
        }

        // Return JSON response with success status and like status
        return response()->json([
            'status' => true,
            'liked' => $liked,
            'like_count' => $listing->likedByUsers()->count()
        ]);
    }

    /**
     * Get all listings liked by a specific user.
     */
    public function getUserLikedListings($userId)
    {
        // Fetch liked listings with eager loading to reduce queries
        $likedListings = Like::with(['listing.host'])
            ->where('user_id', $userId)
            ->get();

        if ($likedListings->isEmpty()) {
            return response()->json([
                'status' => 404,
                'message' => 'No liked listings found for the user.',
                'listings' => []
            ]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Successfully fetched liked listings.',
            'listings' => $likedListings
        ]);
    }
}
