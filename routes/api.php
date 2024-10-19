<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\HostController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserAuthController;    
  // get user 
  Route::get('/user', function (Request $request) {     return $request->user(); })->middleware('auth:sanctum');  
  // user authentication routes  
     // register    
     Route::post('/register', [UserAuthController::class, 'register']);   
      // login   
       Route::post('/login', [UserAuthController::class, 'login']);   
       // logout   
        Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');




// get all categories
Route::get('/categories', [CategoryController::class, 'index']);

// get all Locations
Route::get('/locations', [LocationController::class, 'index']);

// Item routes

Route::controller(ListingController::class)->group(function () {
   // add listing
   Route::post('/listings/create', 'create')->middleware('auth:sanctum');
   // get all listings
   Route::get('/listings', 'getAllListings');
   // get listing
   Route::get('/listings/{id}', 'getListing');
});




// Host routes
Route::middleware('auth:sanctum')->post('/host/create', [HostController::class, 'createHost']);

