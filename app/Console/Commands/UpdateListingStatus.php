<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Console\Command;

class UpdateListingStatus extends Command
{
    protected $signature = 'listing:update-status';
    protected $description = 'Update the status of listings based on conditions';

    public function handle()
    {
        $now = Carbon::now();

        // Update to "comingsoon" if the start date is more than a month away
        Listing::where('status', '!=', 'comingsoon')
            ->where('start_date', '>', $now->copy()->addMonth())
            ->update(['status' => 'comingsoon']);

        // Update to "active" if within start and end dates and available for booking
        Listing::where('status', '!=', 'active')
            ->where('start_date', '<=', $now->copy()->addMonth())
            ->where('end_date', '>=', $now)
            ->whereDoesntHave('bookings', function ($query) {
                $query->where('status', 'accepted')
                    ->whereRaw('DATEDIFF(checkout_date, checkin_date) >= DATEDIFF(end_date, start_date)');
            })
            ->update(['status' => 'active']);

        // // Update to "soldout" if all dates within start_date and end_date are fully booked
        // Listing::where('status', '!=', 'soldout')
        // ->where('start_date', '<=', $now)
        // ->where('end_date', '>=', $now)
        // ->whereDoesntHave('bookings', function ($query) use ($now) {
        //     // Ensure there are no available dates
        //     $query->where('status', 'accepted')
        //         ->where(function ($subQuery) use ($now) {
        //             $subQuery->where(function ($q) use ($now) {
        //                 $q->where('checkin_date', '>', $now) 
        //                     ->orWhere('checkout_date', '<', $now); 
        //             });
        //         });  
        // })
        // ->update(['status' => 'soldout']);

        // Update to "inactive" if past the end date
        Listing::where('status', '!=', 'inactive')
            ->where('end_date', '<', $now)
            ->update(['status' => 'inactive']);

        $this->info('Listing statuses have been updated based on dates and booking status.');
    }
}
