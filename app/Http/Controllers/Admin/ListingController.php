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
         session()->flash('toaster-success', 'Listing updated successfully.');
         return redirect()->route('listings.index');
     }
     
     public function confirm(Listing $listing)
     {
         $listing->confirmed = !$listing->confirmed;
         $listing->save();
         session()->flash(
             'toaster-success',
             $listing->confirmed ? 'Listing confirmed successfully.' : 'Listing unconfirmed successfully.'
         );
         return redirect()->route('listings');
     }
     
     public function destroy(Listing $listing)
     {
         $listing->delete();
         session()->flash('toaster-success', $listing->title . ' deleted successfully.');
         return redirect()->route('listings');
     }
     
}
