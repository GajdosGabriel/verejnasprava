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
        Route::get('{user}/{name}/invitation', 'UserController@sendInvitation')->name('invitation');

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

    Route::name('council.')->namespace('Councils')->group(function() {

        Route::get('zastupitelstva', 'CouncilController@index')->name('index');
        Route::get('zastupitelstvo/{council}/{slug}/user/list', 'CouncilController@userList')->name('userList');
        Route::post('{organization}/{slug}/council/store', 'CouncilController@store')->name('store');

        Route::prefix('admin')->name('admin.')->group(function() {
            Route::get('{organization}/{slug}/index', 'AdminCouncilController@index')->name('index');
            Route::get('{organization}/{slug}/create', 'AdminCouncilController@create')->name('create');
            Route::get('{council}/{slug}/edit/zast', 'AdminCouncilController@edit')->name('edit');
            Route::get('{council}/{slug}/council/delete', 'AdminCouncilController@delete')->name('delete');
        });
    });

    Route::prefix('meet')->name('meet.')->namespace('Councils')->group(function() {
        Route::get('{council}/index', 'MeetingController@index')->name('index');
        Route::get('{council}/meeting/create', 'MeetingController@create')->name('create');
        Route::post('{council}/meeting/store', 'MeetingController@store')->name('store');

        Route::get('{meeting}/pdf/show', 'MeetingController@pozvankaPdf');

    });

    Route::prefix('item')->name('item.')->namespace('Councils')->group(function() {
        Route::put('position/slug/item/position', 'ItemOrderController@position')->name('position');
    });

    Route::prefix('itemMeeting')->name('itemMeeting.')->namespace('Councils')->group(function() {
        Route::get('{meeting}/create', 'ItemMeetingController@create')->name('create');
        Route::put('{item}/addToMeeting', 'ItemMeetingController@update')->name('update');
        Route::post('{meeting}/store', 'ItemMeetingController@store')->name('store');
        Route::get('{item}/delete', 'ItemMeetingController@delete')->name('delete');
    });

    Route::prefix('meetingUser')->namespace('Councils')->group(function() {
        Route::post('store/{meeting}', 'MeetingUserController@store');
        Route::put('update/{meeting}', 'MeetingUserController@update');
        Route::delete('delete/{meeting}', 'MeetingUserController@destroy');
    });


    Route::name('post.')->namespace('Posts')->group(function() {
        Route::get('post/copy/{post}', 'PostController@copy')->name('copy');
    });


    Route::name('contact.')->namespace('Contacts')->group(function() {
        Route::get('contacts', 'ContactsController@index')->name('index');
        Route::get('contact/create/{organization}', 'ContactsController@create')->name('create');
        Route::get('contact/edit/{organization}', 'ContactsController@edit')->name('edit');
        Route::patch('contact/update/{contact}', 'ContactsController@update')->name('update');
        Route::post('contact/store/{organization}', 'ContactsController@store')->name('store');
    });


    Route::resources([
        'users'             => UserController::class,
        'tasks'             => TaskController::class,
        'supports'          => SupportController::class,
        'comments'          => CommentController::class,
        'posts'             => Posts\PostController::class,
        'items'             => Councils\ItemController::class,
        'meetings'          => Councils\MeetingController::class,
        'interpellations'   => Councils\InterpellationController::class,
        'organizations'     => Organizations\OrganizationController::class,
    ]);


    Route::get('test/test/test', 'TestController@test');
    Route::get('test/test/artisan', 'TestController@artisan');

});


Auth::routes();




