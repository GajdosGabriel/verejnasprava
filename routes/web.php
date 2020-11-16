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


Route::group(['middleware' => 'auth'], function () {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function () {
        Route::get('{user}/{slug}/home', 'UserController@home')->name('home');
        Route::get('{user}/{name}/invitation', 'UserController@sendInvitation')->name('invitation');

        Route::get('user/setup/', 'UserController@setup')->name('setup');
    });

    Route::prefix('objednavky')->name('order.')->group(function () {
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

    Route::name('council.')->namespace('Councils')->group(function () {

        Route::get('zastupitelstva', 'CouncilController@index')->name('index');
        Route::get('zastupitelstvo/{council}/{slug}/user/list', 'CouncilController@userList')->name('userList');
        Route::post('{organization}/{slug}/council/store', 'CouncilController@store')->name('store');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('{organization}/{slug}/index', 'AdminCouncilController@index')->name('index');
            Route::get('{organization}/{slug}/create', 'AdminCouncilController@create')->name('create');
            Route::get('{council}/{slug}/edit/zast', 'AdminCouncilController@edit')->name('edit');
        });
    });


    Route::get('meet/{meeting}/pdf/show', 'Councils\MeetingController@pozvankaPdf')->name('meet');
    Route::put('item/position/slug/item/position', 'Councils\ItemOrderController@position')->name('item.position');
    Route::get('post/copy/{post}', 'Posts\PostController@copy')->name('post.copy');


    // https://laraveldaily.com/nested-resource-controllers-and-routes-laravel-crud-example/
    Route::resources([
        'comments'          => 'CommentController',
        'contacts'          => 'Contacts\ContactsController',
        'councils.meetings' => 'Councils\CouncilMeetingController',
        'interpellations'   => 'Councils\InterpellationController',
        'items'             => 'Councils\ItemController',
        'supports'          => 'SupportController',
        'meetings'          => 'Councils\MeetingController',
        'meetings.items'    => 'Councils\ItemMeetingController',
        'meetings.users'    => 'Councils\MeetingUserController',
        'organizations'     => 'Organizations\OrganizationController',
        'posts'             => 'Posts\PostController',
        'tasks'             => 'TaskController',
        'users'             => 'UserController',
    ]);


    Route::get('test/test/test', 'TestController@test');


});


Auth::routes();




