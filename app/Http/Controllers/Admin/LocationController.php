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

    // create
    public function create(){

        return view('admin.locations.create');
    }

    // store
    public function store(Request $request){

        $request->validate([
            'city' => 'required',
           'region' => 'required',
           'country' => 'required',
           'city' => 'required|unique:locations,city,NULL,id,region,' . $request->region . ',country,' . $request->country,
           'region' => 'required',
           'country' => 'required',
        ]);

        $location = Location::create($request->all());
        return redirect()->route('locations')->with('success', 'Location created successfully.');
    }

    // edit
    public function edit($id){
        $location = Location::find($id);
        return view('admin.locations.edit' , compact('location'));
    }

    // update
    public function update(Request $request , $id){

       request()->validate([
           'city' => 'required',
           'region' => 'required',
           'country' => 'required',
           'city' => 'required|unique:locations,city,NULL,id,region,' . $request->region . ',country,' . $request->country,
           'region' => 'required',
           'country' => 'required',
       ]);

        $location = Location::find($id);
        $location->update($request->all());
        return redirect()->route('locations')->with('success', 'Location updated successfully.');
    }

    // destroy
    public function destroy(Location $location){
        $location->delete();
        return redirect()->route('locations')->with('success', 'Location deleted successfully.');
    }
}
