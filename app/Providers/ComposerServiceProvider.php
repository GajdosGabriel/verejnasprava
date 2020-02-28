<?php

namespace App\Providers;

use App\Activity;
use App\Organization;
use App\Post;
use Illuminate\Foundation\Auth\User;
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
            $view->with('organizationNav', $organization);
        });

        view()->composer('organizations.index', function ($view) {
            $activities = Activity::whereUserId(auth()->user()->id)->latest()->with('subject')->paginate(20);
            $view->with('activities', $activities);
        });

    }
}
