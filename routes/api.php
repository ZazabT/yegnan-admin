<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\HostController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserAuthController;    
// get user 
Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:sanctum');  
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

// List routes

Route::controller(ListingController::class)->group(function () {
   // add listing
Route::post('/listings/create', 'create')->middleware('auth:sanctum');
   // get all listings
Route::get('/listings', 'getAllListings');
   // get listing
Route::get('/listing/{id}', 'getListing');
   // update listing
Route::put('/listing/{id}', 'updateListing')->middleware('auth:sanctum');
   // delete listing
Route::delete('/listing/{id}', 'deleteListing')->middleware('auth:sanctum');
});


// Host routes

// Create Host
Route::middleware('auth:sanctum')->post('/host/create', [HostController::class, 'createHost']);
// get host info
Route::middleware('auth:sanctum')->get('/host/profile/{id}', [HostController::class, 'getHostProfile']);
// update host info
Route::middleware('auth:sanctum')->get('/host/profile/update/{id}', [HostController::class, 'updateHostProfile']);


// Guest Route
Route::middleware('auth:sanctum')->get('/guest/profile/{id}', [GuestController::class, 'getGuestProfile']);




// Booking routes 

// reserve listing
Route::middleware('auth:sanctum')->post('/booking/reserve', [BookingController::class, 'reserve']);
// get Bookings for all listing of the spesific host  
Route::middleware('auth:sanctum')->get('/bookings/host/{id}', [BookingController::class, 'getHostBookings']);
// get all booking of the specific guest 
Route::middleware('auth:sanctum')->get('/bookings/guest/{id}', [BookingController::class, 'getGuestBookings']);
// get booking by id
Route::middleware('auth:sanctum')->get('/booking/{id}', [BookingController::class, 'getBookingbyId']);
// accept booking
Route::middleware('auth:sanctum')->put('/booking/acceptbooking/{id}', [BookingController::class, 'acceptBooking']);
//reject booking
Route::middleware('auth:sanctum')->put('/booking/rejectbooking/{id}', [BookingController::class, 'rejectBooking']);
// get todays checkings for the host
Route::middleware('auth:sanctum')->get('/bookings/host/today/{id}', [BookingController::class, 'getTodaysCheckings']);
// get todays checkings for the guest
Route::middleware('auth:sanctum')->get('/bookings/guest/today/{id}', [BookingController::class, 'getGuestTodaysCheckings']);



// Conversation routes

// sayHi
Route::middleware('auth:sanctum')->post('/sayHi', [ConversationController::class, 'sayHi']);
// getConversationMessages
Route::middleware('auth:sanctum')->get('/getConversationMessages/{id}', [ConversationController::class, 'getConversationMessages']);
// usersConversationWith
Route::middleware('auth:sanctum')->get('/usersConversationWith/{id}', [ConversationController::class, 'usersConversationWith']);


// Message routes
Route::middleware('auth:sanctum')->post('/sendmessage', [MessageController::class, 'sendMessage']);




// Like routes
Route::middleware('auth:sanctum')->post('/listings/{listing}/like', [LikeController::class, 'like']);
Route::middleware('auth:sanctum')->get('/listings/likedListings/{id}' , [LikeController::class, 'getUserLikedListings']);
