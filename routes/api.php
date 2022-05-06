<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\MeetingController;
use App\Http\Controllers\Api\UserTaskController;
use App\Http\Controllers\Api\InvitationController;
use App\Http\Controllers\Api\MeetingItemController;
use App\Http\Controllers\Api\MeetingUserController;
use App\Http\Controllers\Api\UserMeetingController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\CouncilMeetingController;
use App\Http\Controllers\Api\OrganizationTagController;
use App\Http\Controllers\Api\OrganizationItemController;
use App\Http\Controllers\Api\OrganizationPostController;
use App\Http\Controllers\Api\OrganizationUserController;
use App\Http\Controllers\Api\MeetingInvitationController;
use App\Http\Controllers\Api\ItemInterpellationController;
use App\Http\Controllers\Api\OrganizationContactController;
use App\Http\Controllers\Api\OrganizationCouncilController;

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
    'votes'                     => VoteController::class,
    'items.interpellations'     => ItemInterpellationController::class,
    'meetings'                  => MeetingController::class,
    'councils.meetings'         => CouncilMeetingController::class,
    'meetings.invitations'      => MeetingInvitationController::class,
    'meetings.items'            => MeetingItemController::class,
    'meetings.users'            => MeetingUserController::class,
    'organizations.tags'        => OrganizationTagController::class,
    'organizations.users'       => OrganizationUserController::class,
    'organizations.contacts'    => OrganizationContactController::class,
    'organizations.councils'    => OrganizationCouncilController::class,
    'organizations.posts'       => OrganizationPostController::class,
    'organizations.items'       => OrganizationItemController::class,
    'users.meetings'            => UserMeetingController::class,
    'invitations'               => InvitationController::class,
    'menus'                     => MenuController::class,
    'organizations'             => OrganizationController::class,
    'users'                     => UserController::class,
    'users.tasks'               => UserTaskController::class,
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
