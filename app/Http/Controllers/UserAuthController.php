<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        try {
            // Validate input data, including password confirmation
            $validator = Validator::make($request->all(), [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'age' => ['required', 'integer', 'min:18', 'max:120'],
            ]);
    
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ] , 422); // Unprocessable entity
            }
    
            // Create a new user
            $user = User::create($validator->validated());
    
            // Ensure user creation was successful
            if (!$user) {
                return response()->json([
                    'status' => 500,
                    'message' => 'User registration failed',
                ],500); // Internal server error
            }
    
            // Create token for the new user
            $token = $user->createToken('auth_token')->plainTextToken;

            // and also create a separet guest table for the user
            $guest = Guest::create([
                'user_id' => $user->id
            ]);
    
            return response()->json([
                'status' => 201,
                'message' => 'User registered successfully',
                'access_token' => $token,
                'user' => $user,
            ] , 201); // Created successfully
    
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500); // Internal server error
        } catch (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ],500); // Internal server error
        }
    }
    

    // Login
    public function login(Request $request)
    {
        try {
            // Validate input data
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Validation errors',
                    'errors' => $validator->errors()
                ],422); // Unprocessable entity
            }

            // Attempt to login
            if (!Auth::attempt($validator->validated())) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid login details',
                ],401); // Unauthorized
            }

            // Retrieve user and create token
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'User not found',
                ],404); // Not Found
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'access_token' => $token,
                'user' => $user,
                'token_type' => 'Bearer',
            ],200); // Success

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ],500); // Internal server error
        } catch (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Login failed',
                'error' => $e->getMessage(),
            ],500); // Internal server error
        }
    }

    // Logout
    public function logout(Request $request)
    {
        try {
            // Ensure the user is authenticated
            if (!$request->user()) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Not authenticated',
                ],401); // Unauthorized
            }

            // Check if the user has any active tokens
            if ($request->user()->currentAccessToken()) {
                // Revoke the current token
                $request->user()->currentAccessToken()->delete();
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No active token found',
                ],404); // Not Found
            }

            return response()->json([
                'status' => 200,
                'message' => 'Logged out successfully',
            ],200); // Success

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
            ],500); // Internal server error
        } catch (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
            ],500); // Internal server error
        }
    }

    
}
