<?php

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResources([
    'votes'                     => 'Api\VoteController',
    'items'                     => 'Api\ItemController',
    'meetings'                  => 'Api\MeetingController',
    'meetings.invitation'       => 'Api\MeetingInvitationController',
    'organizations.tags'        => 'Api\OrganizationTagController',
    'organizations.users'       => 'Api\OrganizationUserController',
    'organizations.contacts'    => 'Api\OrganizationContactController',
    'organizations.posts'       => 'Api\OrganizationPostController',
    'users.meetings'            => 'Api\UserMeetingController',
    'invitations'               => 'Api\InvitationController',
    'menus'                     => 'Api\MenuController',
    'organization'              => 'Api\OrganizationController',
    'users.tasks'               => 'Api\UserTaskController',
    ]);
});

Route::get('artisan/run', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('optimize:clear');

    dd("All is cleared");
});

Route::get('artisan/run/queue', function () {
    \Artisan::call('queue:work');

    dd("Queue working");
});
