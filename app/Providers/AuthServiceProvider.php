<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Post' => 'App\Policies\PostPolicy',
         'App\Models\Customer' => 'App\Policies\CustomerPolicy',
         'App\Models\Organization' => 'App\Policies\OrganizationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-post', function ($user, $post) {
            return $user->id == $post->user_id;
        });


        Gate::define('admin', function ($user) {
            return $user->role == 'admin';
        });
    }
}
