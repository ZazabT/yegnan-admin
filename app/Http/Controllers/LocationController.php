<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // get all locations
    public function index(){
        // Try to get all locations
        try {
            // Fetch locations
            $location = Location::all();
            
            // Return the locations as a JSON response
            return response()->json([
                'status' => 200,
                'locations' => $location],200);
        } catch (\Throwable $th) {

            // Return an error response
            return response()->json([
                'status' => 500,
                'message' => 'Failed to retrieve locations',
            'error' => $th->getMessage()], 500);
        }
    }
}
