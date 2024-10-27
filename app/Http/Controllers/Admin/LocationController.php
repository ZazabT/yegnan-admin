<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //index
    public function index(){
        $locations = Location::paginate(8);

        return view('admin.locations.index' , compact('locations'));
    }
}
