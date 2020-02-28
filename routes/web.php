<?php


Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@redirect')->name('redirect');
Route::get('/contact', 'HomeController@contact')->name('home.contact');


Route::get('download/{filepath?}', 'UserController@download');
Route::get('pdf', 'OrderController@showPdf');


Route::group(['middleware' => 'auth'], function() {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function() {
        Route::get('{user}/{name}/index',  'UserController@index')->name('index');
        Route::get('{user}/{name}/new-organization', 'UserController@newOrganization')->name('new-organization');
    });

    Route::prefix('obj')->name('order.')->group(function() {
        Route::get('{organization}/{slug}/orders', 'OrderController@index')->name('index');
        Route::get('{organization}/{slug}/order/create', 'OrderController@create')->name('create');
        Route::get('{order}/{slug}/order/show', 'OrderController@show')->name('show');
        Route::get('{order}/{slug}/order/delete', 'OrderController@delete')->name('delete');
        Route::post('{organization}/{slug}/order/store', 'OrderController@store')->name('store');
    });

    Route::prefix('org')->name('org.')->middleware(['checkOrganization'])->namespace('Organizations')->group(function() {
        Route::get('{organization}/{slug}/index', 'OrganizationController@index')->name('index');
        Route::get('{organization}/{slug}/edit', 'OrganizationController@edit')->name('edit');
        Route::post('{user}/{name}/store', 'OrganizationController@store')->name('store');
        Route::put('{organization}/{slug}/update', 'OrganizationController@update')->name('update');


        Route::name('post.')->namespace('Posts')->group(function() {
            Route::get('{organization}/{slug}/post', 'PostController@index')->name('index');
            Route::get('{organization}/{slug}/post/create', 'PostController@create')->name('create');
            Route::get('{post}/{slug}/post/copy', 'PostController@copy')->name('copy');
            Route::get('{post}/{slug}/post/edit', 'PostController@edit')->name('edit');
            Route::put('{post}/{slug}/post/update', 'PostController@update')->name('update');
            Route::post('{organization}/{slug}/post/store', 'PostController@store')->name('store');
            Route::delete('{organization}/{slug}/post/delete', 'PostController@delete')->name('delete');
        });

        Route::name('contact.')->namespace('Contacts')->group(function() {
            Route::get('{organization}/{slug}/contact', 'ContactsController@index')->name('index');
            Route::get('{organization}/{slug}/contact/create', 'ContactsController@create')->name('create');
            Route::get('{organization}/{slug}/contact/edit', 'ContactsController@edit')->name('edit');
            Route::post('{organization}/{slug}/contact/store', 'ContactsController@store')->name('store');
            Route::put('{organization}/{slug}/contact/update', 'ContactsController@update')->name('update');
        });

    });


    Route::name('question.')->group(function() {
        Route::get('{user}/{name}/question/index',  'QuestionsController@index')->name('index');
        Route::post('question/question/question/store/fasfas',  'QuestionsController@store')->name('store');
    });

});


Auth::routes();




