<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Organization;
use App\Models\Post;
use Carbon\Carbon;
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

        view()->composer('post.create', function ($view) {
            $posts = Post::whereOrganizationId(auth()->user()->active_organization)->latest()->get()->take(4);
            $view->with('posts', $posts);
        });

        view()->composer('public.index', function ($view) {
            $posts =  Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
                return Carbon::parse($item->date_in)->format('F-Y');
            });
            $view->with('posts', $posts);
        });

    }
}
