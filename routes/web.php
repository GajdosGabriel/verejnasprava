<?php

// Zmena auth Usera
// $userId = 137;
// Auth::loginUsingId($userId, true);
Route::group(['middleware' => ['checkAuth']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/home', 'HomeController@redirect');
    Route::get('/contact', 'HomeController@contact')->name('home.contact');
    Route::get('/zverejnovanie', 'HomeController@zverejnovanie')->name('home.zverejnovanie');
    Route::get('/gdpr', 'HomeController@gdpr')->name('home.gdpr');
    Route::post('/contactUs', 'HomeController@store')->name('home.contactUs');
});


Route::get('/posts/frontPostsTable', 'HomeController@frontPosts');

Route::get('{organization}/{slug}/index', 'HomeController@publishedPosts')->name('publishedPosts');
Route::get('file/{file}/{filename?}/file/show', 'FilesController@show')->name('file.show');

// oAuth Routes...
Route::get('/auth/{service}', 'Auth\AuthController@redirectToProvider')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::get('/auth/{service}/callback', 'Auth\AuthController@handleProviderCallback')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::group(['middleware' => 'auth'], function () {

    Route::resources([
        'organizations'   => 'Organizations\OrganizationController',
    ]);
});

Route::group(['middleware' => ['auth', 'checkOrganization']], function () {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function () {
        Route::get('{user}/invitation', 'UserController@sendInvitation')->name('invitation');
        Route::get('users/setup/', 'UserController@setup')->name('setup');
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
    });


    Route::get('meetings/{meeting}/file/show', 'Meetings\MeetingController@pozvankaPdf')->name('meet');
    Route::put('item/position/slug/item/position', 'Items\ItemOrderController@position')->name('item.position');
    Route::get('posts/copy/{post}', 'Posts\PostController@copy')->name('post.copy');


    // https://laraveldaily.com/nested-resource-controllers-and-routes-laravel-crud-example/
    Route::resources([
        'comments'              => 'CommentController',
        'councils'              => 'Councils\CouncilController',
        'councils.meetings'     => 'Councils\CouncilMeetingController',
        'interpellations'       => 'Councils\InterpellationController',
        'items'                 => 'Items\ItemController',
        'supports'              => 'SupportController',
        'meetings'              => 'Meetings\MeetingController',
        'meetings.items'        => 'Meetings\MeetingItemController',
        'organizations.councils' => 'Organizations\OrganizationCouncilController',
        'organizations.users'   => 'Organizations\OrganizationUserController',
        'organizations.contacts' => 'Organizations\OrganizationContactController',
        'posts'                 => 'Posts\PostController',
        'tasks'                 => 'Tasks\TaskController',
        'tasks.comments'        => 'Tasks\TaskCommentController',
        'users'                 => 'UserController',
        'tags'                  => 'TagController',
        'messengers'            => 'MessengerController',
        'contacts'              => 'Contacts\ContactsController',
    ]);


    Route::get('test/test/test', 'TestController@test');
});


Auth::routes();
