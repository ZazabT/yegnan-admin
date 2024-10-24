<?php

namespace App\Http\Controllers\Admin;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
     // get all listings
     public function index()
     {
        $listings = Listing::with(['item_images' , 'categories' , 'location' , 'host.user'])->paginate(8);
         return view('admin.listings.index', compact('listings'));
     }


     // edit listing
     public function edit(Listing $listing)
     {
        return view('admin.listings.edit', compact('listing'));
     }

     // update listing
     public function update(Request $request, Listing $listing)
     {
         $listing->update($request->all());
         return redirect()->route('listings.index')->with('success', 'Listing updated successfully.');
     }

     // confirm a listing
     public function confirm(Request $request , Listing $listing){
        $listing->confirmed = !$listing->confirmed;
        $listing->save();
        return redirect()->route('listings') 
            ->with('success', $listing->confirmed ? 'Listing confirmed successfully.' : 'Listing unconfirmed successfully.');
     }
}
