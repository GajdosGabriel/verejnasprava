<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\Support;
use App\Policies\CommentPolicy;
use App\Policies\ContactPolicy;
use App\Policies\SupportPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Post' => 'App\Policies\PostPolicy',
         'App\Models\User' => 'App\Policies\UserPolicy',
         'App\Models\Customer' => 'App\Policies\CustomerPolicy',
         'App\Models\Organization' => 'App\Policies\OrganizationPolicy',
         'App\Models\Comment' => 'App\Policies\CommentPolicy',
        Comment::class => CommentPolicy::class,
        Support::class => SupportPolicy::class,
        Contact::class => ContactPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('delete-post', function ($user, $post) {
        //     return $user->id == $post->user_id;
        // });


        // Gate::define('admin', function ($user) {
        //     return $user->role == 'admin';
        // });
    }
}
