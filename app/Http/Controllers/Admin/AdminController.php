<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // Use the proper Auth facade
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show Login Page
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Show Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Login Method
    public function login(Request $request)
    {
        // Validate login input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to log in with the admin guard
        if (Auth::guard('admin')->attempt($credentials)) {
            // Regenerate session on login
            $request->session()->regenerate();

            // Redirect to the dashboard
            return redirect()->route('dashboard')->with('success', 'You are logged in!');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Logout Method
    public function logout(Request $request)
    {
        // Log out the admin user
        Auth::guard('admin')->logout();

        // Invalidate the session and regenerate the CSRF token to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('showLogin')->with('success', 'Logged out successfully.');
    }
}
