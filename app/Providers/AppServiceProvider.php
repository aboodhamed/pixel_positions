<?php

namespace App\Providers;

use App\Models\Job;
use App\Policies\JobPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\DB;
use App\Database\SQLiteCloudConnector;
use App\Database\SQLiteCloudConnection;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        
    }
}
