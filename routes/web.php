<?php

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@redirect')->name('redirect');
Route::get('/contact', 'HomeController@contact')->name('home.contact');

Route::get('{organization}/{slug}/index', 'HomeController@publishedPosts')->name('publishedPosts');
Route::get('pdf/{file}/{filename?}/download/pdf', 'FilesController@show')->name('file.show');




Route::group(['middleware' => 'auth'], function() {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function() {
        Route::get('{user}/{name}/index',  'UserController@index')->name('index');
        Route::get('{user}/{name}/new-organization', 'UserController@newOrganization')->name('new-organization');
        Route::post('user/store/new/worker', 'UserController@store')->name('store');
    });

    Route::prefix('obj')->name('order.')->group(function() {
        Route::get('{organization}/{slug}/orders', 'OrderController@index')->name('index');
        Route::get('{organization}/{slug}/order/create', 'OrderController@create')->name('create');
        Route::get('{order}/{slug}/order/show', 'OrderController@show')->name('show');
        Route::get('{order}/{slug}/order/edit', 'OrderController@edit')->name('edit');
        Route::get('{order}/{slug}/order/delete', 'OrderController@delete')->name('delete');
        Route::get('{order}/{slug}/order/send', 'OrderController@send')->name('send');
        Route::get('{order}/{slug}/order/pdf', 'OrderController@printPdf')->name('printPdf');
        Route::post('{organization}/{slug}/order/store', 'OrderController@store')->name('store');
        Route::patch('{order}/{slug}/order/update', 'OrderController@update')->name('update');
    });

    Route::prefix('zast')->name('zast.')->namespace('Councils')->group(function() {
        Route::get('{organization}/{slug}/zastupitelstva', 'CouncilController@index')->name('index');
        Route::get('{organization}/{slug}/create', 'CouncilController@create')->name('create');
        Route::get('{organization}/{slug}/edit/zast', 'CouncilController@edit')->name('edit');
        Route::post('{organization}/{slug}/council/store', 'CouncilController@store')->name('store');

    });

    Route::prefix('meet')->name('meet.')->namespace('Councils')->group(function() {
        Route::get('{council}/{slug}/meeting', 'MeetingController@index')->name('index');
        Route::get('{council}/{slug}/meeting/create', 'MeetingController@create')->name('create');
        Route::get('{council}/{slug}/meeting/show', 'MeetingController@show')->name('show');
        Route::post('{council}/{slug}/meeting/store', 'MeetingController@store')->name('store');
    });

    Route::prefix('item')->name('item.')->namespace('Councils')->group(function() {
//            Route::get('{council}/{slug}/meeting', 'ItemController@index')->name('index');
        Route::get('{meeting}/{slug}/item/create', 'ItemController@create')->name('create');
//            Route::get('{council}/{slug}/meeting/show', 'ItemController@show')->name('show');
            Route::post('{meeting}/{slug}/meeting/store', 'ItemController@store')->name('store');
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




