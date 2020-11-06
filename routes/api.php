<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('posts/{userId}', 'Posts\ApiPostController@index');
Route::get('contacts/{organizationId}', 'Organizations\Contacts\ApiContactsController@getContacts');
Route::delete('contacts/{contact}', 'Organizations\Contacts\ApiContactsController@delete');


Route::get('councils/{organization}/index', 'Councils\ApiCouncilController@index');
Route::put('councils/{council}/update', 'Councils\ApiCouncilController@update');


Route::apiResources([
    'votes' => 'Api\VoteController',
    'items' => 'Api\ItemController',
    'meetings' => 'Api\MeetingController',
]);


Route::get('artisan/run', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('optimize:clear');

    dd("All is cleared");

});
