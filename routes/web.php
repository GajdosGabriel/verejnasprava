<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\Items\ItemController;
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Items\ItemOrderController;
use App\Http\Controllers\Contacts\ContactController;
use App\Http\Controllers\Councils\CouncilController;
use App\Http\Controllers\Meetings\MeetingController;
use App\Http\Controllers\UserOrganizationController;
use App\Http\Controllers\Tasks\TaskCommentController;
use App\Http\Controllers\Councils\CouncilUserController;
use App\Http\Controllers\Meetings\MeetingItemController;
use App\Http\Controllers\Councils\CouncilMeetingController;
use App\Http\Controllers\Organizations\OrganizationController;
use App\Http\Controllers\Organizations\OrganizationUserController;
use App\Http\Controllers\Organizations\OrganizationContactController;
use App\Http\Controllers\Organizations\OrganizationCouncilController;

// Zmena auth Usera
// $userId = 137;
// Auth::loginUsingId($userId, true);
Route::group(['middleware' => ['checkAuth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home', [HomeController::class, 'redirect']);
    Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
    Route::get('/zverejnovanie', [HomeController::class, 'zverejnovanie'])->name('home.zverejnovanie');
    Route::get('/gdpr', [HomeController::class, 'gdpr'])->name('home.gdpr');
    Route::post('/contactUs', [HomeController::class, 'store'])->name('home.contactUs');
});


Route::get('/posts/frontPostsTable', [HomeController::class, 'frontPosts']);

Route::get('{organization}/{slug}/index', [HomeController::class, 'publishedPosts'])->name('publishedPosts');
Route::get('file/{file}/{filename?}/file/show', [FilesController::class, 'show'])->name('file.show');

// oAuth Routes...
Route::get('/auth/{service}', [AuthController::class, 'redirectToProvider'])
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::get('/auth/{service}/callback', [AuthController::class, 'handleProviderCallback'])
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::group(['middleware' => 'auth'], function () {

    Route::resources([
        'user.organization'   => UserOrganizationController::class,
    ]);
});

Route::group(['middleware' => ['auth', 'checkOrganization']], function () {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function () {
        Route::get('{user}/invitation', [UserController::class, 'sendInvitation'])->name('invitation');
        Route::get('users/setup/', [UserController::class, 'setup'])->name('setup');
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
        Route::get('zastupitelstva', [CouncilController::class, 'index'])->name('index');
        Route::get('zastupitelstvo/{council}/{slug}/user/list', [CouncilController::class, 'userList'])->name('userList');
    });


    Route::get('meetings/{meeting}/file/show', [MeetingController::class, 'pozvankaPdf'])->name('meet');
    Route::put('item/position/slug/item/position', [ItemOrderController::class, 'position'])->name('item.position');
    Route::get('posts/copy/{post}', [PostController::class, 'copy'])->name('post.copy');


    // https://laraveldaily.com/nested-resource-controllers-and-routes-laravel-crud-example/
    Route::resources([
        'comments'              => CommentController::class,
        'councils'              => CouncilController::class,
        'council.meeting'       => CouncilMeetingController::class,
        'council.user'          => CouncilUserController::class,
        'items'                 => ItemController::class,
        'supports'              => SupportController::class,
        'meetings'              => MeetingController::class,
        'meeting.item'          => MeetingItemController::class,
        'organizations'         => OrganizationController::class,
        'organizations.councils' => OrganizationCouncilController::class,
        'organizations.users'   => OrganizationUserController::class,
        'organization.contact' => OrganizationContactController::class,
        'posts'                 => PostController::class,
        'tasks'                 => TaskController::class,
        'tasks.comments'        => TaskCommentController::class,
        'users'                 => UserController::class,
        'tags'                  => TagController::class,
        'messengers'            => MessengerController::class,
        'contacts'              => ContactController::class,
    ]);


    Route::get('test/test/test', [TestController::class, 'test']);
});


Auth::routes();
