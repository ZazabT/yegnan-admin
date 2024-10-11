<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
  use Illuminate\Support\Facades\Route; 
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



// Item routes

