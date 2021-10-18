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
use Spatie\Permission\Models\Permission;
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
        view()->composer(['organizations.navigation', 'council.meeting.navigation', 'council.items.navigation', 'council.meeting.print', 'organizations.modul_activator', 'organizations.home', 'post.create'], function ($view) {
            $organization = Organization::whereId(auth()->user()->active_organization)->first();
            $view->with('organization', $organization);
        });

        view()->composer('organizations.home', function ($view) {
//            $activities = Activity::whereUserId(auth()->user()->id)->latest()->with('subject')->get();
            $activities = Activity::paginate(50);
            $view->with('activities', $activities);
        });

        view()->composer('post.create', function ($view) {
            $posts = Post::whereOrganizationId(auth()->user()->active_organization)->latest()->get();
            $view->with('posts', $posts->take(5));
            $view->with('postsForCopyTable', $posts->groupBy('contact_id')->take(31));
        });

        view()->composer('post.post-table-predna', function ($view) {
            $posts =  Post::orderBy('date_in', 'desc')->get()->groupBy(function($item){
                return Carbon::parse($item->date_in)->format('F-Y');
            });
            $view->with('posts', $posts);
        });

        view()->composer(['user.edit', 'user.create', 'user.show'], function ($view) {
            $organization = Organization::whereId(auth()->user()->active_organization)->first();
            $roles =  Role::all();
            $permissions =  Permission::all();
            $view->with('roles', $roles)
                    ->with('permissions', $permissions)
                    ->with('organization', $organization);
        });

    }
}
