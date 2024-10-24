<?php

use App\Models\User;
use Termwind\Components\Li;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ListingController;

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
                 Route::get('listings', 'index')->name('listings.index');

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
             });
         });
         