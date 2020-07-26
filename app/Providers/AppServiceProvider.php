<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Observers\ContactObserver;
use App\Observers\ItemOrderObserver;
use App\Observers\OrderItemObserver;
use App\Observers\OrganizationObserver;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Council\Item;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


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
        Item::observe(ItemOrderObserver::class);
        Paginator::useTailwind();


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
