<?php

namespace App\Providers;

use App\Models\Job;
use App\Policies\JobPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Job::class => JobPolicy::class,
   ];


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
