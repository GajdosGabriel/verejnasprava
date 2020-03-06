<?php

namespace App\Providers;

use App\Contact;
use App\Observers\ContactObserver;
use App\Observers\OrderItemObserver;
use App\OrderItem;
use App\User;
use App\Category;
use App\Organization;
use App\Observers\UserObserver;
use App\Observers\OrganizationObserver;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Contact::observe(ContactObserver::class);
        Organization::observe(OrganizationObserver::class);
        OrderItem::observe(OrderItemObserver::class);

        Carbon::setLocale(config('app.locale'));


        view()->composer('user.listAllUsers', function($view)
        {
            $view->with('organizations', Organization::withCount('posts')->get() );
        });


        view()->composer('modul.categoryList',  function($view)
        {
            $view->with('categories', Category::all());
        });


    }
}
