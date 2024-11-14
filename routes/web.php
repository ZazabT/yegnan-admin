<?php

use App\Models\User;
use Termwind\Components\Li;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\LocationController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Admin auth routes
         // get login page
         Route::get('login' , [AdminController::class, 'showLoginForm'])->name('showLogin');
         // login
         Route::post('login' , [AdminController::class, 'login'])->name('login');
         // logout
         Route::post('logout' , [AdminController::class, 'logout'])->name('logout');

// protected admin routes
         // dashboard
         Route::middleware('auth:admin')->group(function () {
             Route::get('' , [AdminController::class, 'dashboard'])->name('dashboard');



             // user controller
             Route::controller(UserController::class)->group(function () {
                         // get all users
                         Route::get('users' , 'index')->name('users');

                         // delete user
                         Route::delete('users/{user}' , 'destroy')->name('users.destroy');
                               
             });



             // listing controller
             Route::controller(ListingController::class)->group(function () {
                 // get all listing
                 Route::get('listings', 'index')->name('listings');

                 // confirm a list 
                 Route::put('listings/{listing}/confirm', 'confirm')->name('listings.confirm');

                 // delete listing
                 Route::delete('listings/{listing}' , 'destroy')->name('listings.destroy');

                 // edit listing
                 Route::get('listings/{listing}/edit' , 'edit')->name('listings.edit');

                 // update listing
                 Route::put('listings/{listing}' , 'update')->name('listings.update');

             });

             // Host controller
             Route::controller(HostController::class)->group(function () {
                 // get all hosts
                 Route::get('hosts' , 'index')->name('hosts');
                 // verify a host 
                 Route::put('/host/verify/{host}' , 'verify')->name('host.verify');
             });





             // Bookings controller
             Route::controller(BookingController::class)->group(function () {
                 // get all bookings
                 Route::get('bookings' , 'index')->name('bookings');
             });




             // Categories controller 
             Route::controller(CategoriesController::class)->group(function(){
                // get all categories
                Route::get('categories' , 'index')->name('categories');
                // get category create page // show
                Route::get('categories/create', 'create')->name('categories.create');
                // create category
                Route::post('categories' , 'store')->name('categories.store');
                // edit category
                Route::get('categories/{category}/edit' , 'edit')->name('categories.edit');
                // update category
                Route::put('categories/{category}' , 'update')->name('categories.update');
                // delete category
                Route::delete('categories/{category}' , 'destroy')->name('categories.destroy');
             });




             //Locations controller
             Route::controller(LocationController::class)->group(function(){
                // get all locations
                Route::get('locations' , 'index')->name('locations');
                // get location create page // show
                Route::get('locations/create' , 'create')->name('locations.create');
                // create location
                Route::post('locations' , 'store')->name('locations.store');
                // edit location
                Route::get('locations/{location}/edit' , 'edit')->name('locations.edit');
                // update location
                Route::put('locations/{location}' , 'update')->name('locations.update');
                // delete location
                Route::delete('locations/{location}' , 'destroy')->name('locations.destroy');


             });

         });
         