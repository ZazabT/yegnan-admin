<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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
             
         });