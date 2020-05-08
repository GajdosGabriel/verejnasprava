<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Council\Council;
use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;


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
        view()->composer(['organizations.navigation', 'council.meeting.navigation', 'council.items.navigation'], function ($view) {
            $organization = Organization::whereId(auth()->user()->active_organization)->first();
            $view->with('object', $organization);
        });

        view()->composer('organizations.home', function ($view) {
            $activities = Activity::whereUserId(auth()->user()->id)->latest()->with('subject')->paginate(20);
            $view->with('activities', $activities);
        });

        view()->composer('post.create', function ($view) {
            $posts = Post::whereOrganizationId(auth()->user()->active_organization)->latest()->get()->take(4);
            $view->with('posts', $posts);
        });

        view()->composer('post.post-table-predna', function ($view) {
            $posts =  Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
                return Carbon::parse($item->date_in)->format('F-Y');
            });
            $view->with('posts', $posts);
        });

        view()->composer(['user.edit', 'user.create'], function ($view) {
            $organization = Organization::whereId(auth()->user()->active_organization)->first();
            $roles =  Role::all();
            $view->with('roles', $roles)
                    ->with('organization', $organization);
        });

    }
}
