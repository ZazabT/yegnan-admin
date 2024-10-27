<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateListingStatus; // Make sure to include this

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the UpdateListingStatus command
        $this->commands([
            UpdateListingStatus::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {
        Paginator::useBootstrap();
        
        // Schedule the command to run hourly
        $schedule->command('listing:update-status')->hourly();
    }
}
