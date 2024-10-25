<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    //index
    public function index()
    {
        $bookings = Booking::with(['listing', 'guest'])->paginate(8);
        return view('admin.booking.index' , compact('bookings'));
    }
}
