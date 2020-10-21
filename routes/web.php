<?php


Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@redirect');
Route::get('/contact', 'HomeController@contact')->name('home.contact');
Route::get('/zverejnovanie', 'HomeController@zverejnovanie')->name('home.zverejnovanie');
Route::get('/gdpr', 'HomeController@gdpr')->name('home.gdpr');

Route::get('/posts/frontPostsTable', 'HomeController@frontPosts');

Route::get('{organization}/{slug}/index', 'HomeController@publishedPosts')->name('publishedPosts');
Route::get('pdf/{file}/{filename?}/download/pdf', 'FilesController@show')->name('file.show');

// oAuth Routes...
Route::get('/auth/{service}', 'Auth\AuthController@redirectToProvider')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::get('/auth/{service}/callback', 'Auth\AuthController@handleProviderCallback')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');


Route::group(['middleware' => 'auth'], function() {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function() {
        Route::get('{user}/{slug}/home', 'UserController@home')->name('home');
        Route::get('{organization}/{slug}/index', 'UserController@index')->name('index');
        Route::get('{organization}/{slug}/create', 'UserController@create')->name('create');
        Route::get('{user}/{slug}/edit', 'UserController@edit')->name('edit');
        Route::get('{user}/{name}/invitation', 'UserController@sendInvitation')->name('invitation');
        Route::post('{organization}/store', 'UserController@store')->name('store');
        Route::patch('{user}/update', 'UserController@update')->name('update');
        Route::get('{user}/{slug}/delete', 'UserController@delete')->name('delete');

        Route::get('user/setup/', 'UserController@setup')->name('setup');
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
            Route::post('{organization}/{slug}/council/store', 'AdminCouncilController@store')->name('store');
            Route::get('{council}/{slug}/council/delete', 'AdminCouncilController@delete')->name('delete');
        });
    });

    Route::prefix('meet')->name('meet.')->namespace('Councils')->group(function() {
        Route::get('{council}/{slug}/index', 'MeetingController@index')->name('index');
        Route::get('{meeting}/{slug}/show', 'MeetingController@show')->name('show');
        Route::get('{council}/{slug}/meeting/create', 'MeetingController@create')->name('create');
        Route::get('{meeting}/{slug}/meeting/edit', 'MeetingController@edit')->name('edit');
        Route::get('{meeting}/{slug}/meeting/published', 'MeetingController@published')->name('published');
        Route::put('{meeting}/{slug}/meeting/update', 'MeetingController@update')->name('update');
        Route::post('{council}/{slug}/meeting/store', 'MeetingController@store')->name('store');
        Route::get('{meeting}/{slug}/meeting/delete', 'MeetingController@delete')->name('delete');

    });

    Route::prefix('item')->name('item.')->namespace('Councils')->group(function() {
        Route::get('items/meitems/index', 'ItemController@index')->name('index');
        Route::get('item/meitem/create', 'ItemController@create')->name('create');
        Route::get('{item}/{slug}/show', 'ItemController@show')->name('show');
        Route::get('{item}/{slug}/edit', 'ItemController@edit')->name('edit');
        Route::get('{item}/{slug}/item/up', 'ItemOrderController@itemUp')->name('up');
        Route::get('{item}/{slug}/item/down', 'ItemOrderController@itemDown')->name('down');
        Route::post('store', 'ItemController@store')->name('store');
        Route::put('{item}/{slug}/meeting/update', 'ItemController@update')->name('update');
        Route::get('{item}/{slug}/item/delete', 'ItemController@delete')->name('delete');
    });

    Route::prefix('itemMeeting')->name('itemMeeting.')->namespace('Councils')->group(function() {
        Route::get('{meeting}/create', 'ItemMeetingController@create')->name('create');
        Route::post('{meeting}/store', 'ItemMeetingController@store')->name('store');
        Route::get('{item}/delete', 'ItemMeetingController@delete')->name('delete');
    });


    Route::prefix('org')->name('org.')->middleware(['checkOrganization'])->namespace('Organizations')->group(function() {
        Route::get('{organization}/{slug}/index', 'OrganizationController@index')->name('index');
        Route::get('{cokolvek}/{name}/create', 'OrganizationController@create')->name('create');
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
        Route::patch('contact/update/{contact}', 'ContactsController@update')->name('update');
        Route::post('contact/store/{organization}', 'ContactsController@store')->name('store');
    });

    Route::name('task.')->group(function() {
        Route::get('tasks', 'TaskController@index')->name('index');
    });



    Route::name('question.')->group(function() {
        Route::get('question/index',  'QuestionsController@index')->name('index');
        Route::post('question/store',  'QuestionsController@store')->name('store');
    });

    Route::get('test/test/test', 'TestController@test');
    Route::get('test/test/artisan', 'TestController@artisan');

});


Auth::routes();




