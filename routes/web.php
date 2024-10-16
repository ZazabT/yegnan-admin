<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;

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
         });
         