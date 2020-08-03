<?php


Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@redirect');
Route::get('/contact', 'HomeController@contact')->name('home.contact');
Route::get('/zverejnovanie', 'HomeController@zverejnovanie')->name('home.zverejnovanie');

Route::get('{organization}/{slug}/index', 'HomeController@publishedPosts')->name('publishedPosts');
Route::get('pdf/{file}/{filename?}/download/pdf', 'FilesController@show')->name('file.show');




Route::group(['middleware' => 'auth'], function() {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function() {
        Route::get('{user}/{slug}/home', 'UserController@home')->name('home');
        Route::get('{organization}/{slug}/index', 'UserController@index')->name('index');
        Route::get('{organization}/{slug}/create', 'UserController@create')->name('create');
        Route::get('{user}/{slug}/edit', 'UserController@edit')->name('edit');
        Route::get('{user}/{name}/new-organization', 'UserController@newOrganization')->name('new-organization');
        Route::get('{user}/{name}/invitation', 'UserController@sendInvitation')->name('invitation');
        Route::post('{organization}/store/store', 'UserController@store')->name('store');
        Route::patch('{user}/update/update', 'UserController@update')->name('update');
        Route::get('{user}/{slug}/delete/delete', 'UserController@delete')->name('delete');
    });

    Route::prefix('objednavky')->name('order.')->group(function() {
        Route::get('/index', 'OrderController@index')->name('index');
        Route::get('{organization}/{slug}/order/create', 'OrderController@create')->name('create');
        Route::get('{order}/{slug}/order/show', 'OrderController@show')->name('show');
        Route::get('{order}/{slug}/order/edit', 'OrderController@edit')->name('edit');
        Route::get('{order}/{slug}/order/delete', 'OrderController@delete')->name('delete');
        Route::get('{order}/{slug}/order/send', 'OrderController@send')->name('send');
        Route::get('{order}/{slug}/order/pdf', 'OrderController@printPdf')->name('printPdf');
        Route::post('{organization}/{slug}/order/store', 'OrderController@store')->name('store');
        Route::patch('{order}/{slug}/order/update', 'OrderController@update')->name('update');
    });

    Route::name('zast.')->namespace('Councils')->group(function() {

        Route::get('zastupitestva', 'CouncilController@index')->name('index');
        Route::get('zastupitestvo/{council}/{slug}/user/list', 'CouncilController@userList')->name('userList');

        Route::prefix('admin')->name('admin.')->group(function() {
            Route::get('{organization}/{slug}/index', 'AdminCouncilController@index')->name('index');
            Route::get('{organization}/{slug}/create', 'AdminCouncilController@create')->name('create');
            Route::get('{council}/{slug}/edit/zast', 'AdminCouncilController@edit')->name('edit');
            Route::put('{council}/{slug}/update/zast', 'AdminCouncilController@update')->name('update');
            Route::post('{organization}/{slug}/council/store', 'AdminCouncilController@store')->name('store');
            Route::get('{council}/{slug}/council/delete', 'AdminCouncilController@delete')->name('delete');
        });
    });

    Route::prefix('meet')->name('meet.')->namespace('Councils')->group(function() {
        Route::get('{council}/{slug}/index', 'MeetingController@index')->name('index');
        Route::get('{council}/{slug}/meeting/create', 'MeetingController@create')->name('create');
        Route::get('{meeting}/{slug}/meeting/edit', 'MeetingController@edit')->name('edit');
        Route::get('{meeting}/{slug}/meeting/published', 'MeetingController@published')->name('published');
        Route::put('{meeting}/{slug}/meeting/update', 'MeetingController@update')->name('update');
        Route::post('{council}/{slug}/meeting/store', 'MeetingController@store')->name('store');
        Route::get('{meeting}/{slug}/meeting/delete', 'MeetingController@delete')->name('delete');

    });

    Route::prefix('item')->name('item.')->namespace('Councils')->group(function() {
        Route::get('{meeting}/{slug}/index', 'ItemController@index')->name('index');
        Route::get('{meeting}/{slug}/create', 'ItemController@create')->name('create');
        Route::get('{item}/{slug}/show', 'ItemController@show')->name('show');
        Route::get('{item}/{slug}/edit', 'ItemController@edit')->name('edit');
        Route::get('{item}/{slug}/item/published', 'ItemController@published')->name('published');
        Route::get('{item}/{slug}/item/up', 'ItemOrderController@itemUp')->name('up');
        Route::get('{item}/{slug}/item/down', 'ItemOrderController@itemDown')->name('down');
        Route::post('{meeting}/{slug}/meeting/store', 'ItemController@store')->name('store');
        Route::put('{item}/{slug}/meeting/update', 'ItemController@update')->name('update');
        Route::get('{item}/{slug}/item/delete', 'ItemController@delete')->name('delete');
    });

    Route::prefix('inter')->name('interpellation.')->namespace('Councils')->group(function() {
        Route::get('{item}/{slug}/item/interpellation', 'InterpellationController@store')->name('store');
    });

//    Route::prefix('vote')->name('vote.')->namespace('Councils')->group(function() {
//        Route::get('{item}/{slug}/vote/enable', 'VoteController@voteEnable')->name('voteEnable');
//
//    });

    Route::prefix('org')->name('org.')->middleware(['checkOrganization'])->namespace('Organizations')->group(function() {
        Route::get('{organization}/{slug}/index', 'OrganizationController@index')->name('index');
        Route::get('{organization}/{slug}/edit', 'OrganizationController@edit')->name('edit');
        Route::post('{user}/{name}/store', 'OrganizationController@store')->name('store');
        Route::put('{organization}/{slug}/update', 'OrganizationController@update')->name('update');
    });

    Route::name('post.')->namespace('Posts')->group(function() {
        Route::get('posts', 'PostController@index')->name('index');
        Route::get('post/create', 'PostController@create')->name('create');
        Route::get('post/copy/{post}', 'PostController@copy')->name('copy');
        Route::get('post/edit/{post}', 'PostController@edit')->name('edit');
        Route::post('post/store', 'PostController@store')->name('store');
        Route::put('post/update/{post}', 'PostController@update')->name('update');
        Route::get('post/delete/{post}', 'PostController@delete')->name('delete');
    });


    Route::name('contact.')->namespace('Contacts')->group(function() {
        Route::get('contacts', 'ContactsController@index')->name('index');
        Route::get('contact/create/{organization}', 'ContactsController@create')->name('create');
        Route::get('contact/edit/{organization}', 'ContactsController@edit')->name('edit');
        Route::put('contact/update/{organization}', 'ContactsController@update')->name('update');
        Route::post('contact/store/{organization}', 'ContactsController@store')->name('store');
    });


    Route::name('question.')->group(function() {
        Route::get('question/index',  'QuestionsController@index')->name('index');
        Route::post('question/store',  'QuestionsController@store')->name('store');
    });

});


Auth::routes();




