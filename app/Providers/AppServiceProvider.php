<?php

namespace App\Providers;

use App\User;
use App\Worker;
use App\Company;
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
        Company::observe(Company::class);
        User::observe(UserObserver::class);
        Organization::observe(OrganizationObserver::class);

        Carbon::setLocale(config('app.locale'));


        view()->composer('user.listAllUsers', function($view)
        {
            $view->with('users', User::withCount('posts')->where('role', '<>', 'admin')->orderBy('company', 'asc')->get() );
        });



        view()->composer('post.postform', function($view)
        {
            $view->with('categories', Category::pluck('name', 'id'));
        });

        view()->composer('modul.categoryList',  function($view)
        {
            $view->with('categories', Category::all());
        });


        //Validation of select, dont be a 0
        \Validator::extend('requiredSelectBox', function($attribute, $value, $parameters, $validator) {
            if($value<1) {
                return false;
            }
            return true;
        });
    }
}
