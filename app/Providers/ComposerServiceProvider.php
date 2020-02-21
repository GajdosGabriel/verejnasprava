<?php

namespace App\Providers;

use App\Organization;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('organizations.navigation', function ($view) {
            $organization = Organization::whereId(auth()->user()->active_organization)->first();
            $view->with('organization', $organization);
        });
    }
}
