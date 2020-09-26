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

Route::get('test/test/{id}', 'TestController@test');
Route::get('posts/frontPosts', 'Posts\ApiPostController@frontPosts');
Route::get('posts/{userId}', 'Posts\ApiPostController@index');
Route::get('contacts/{organizationId}', 'Organizations\Contacts\ApiContactsController@getContacts');
Route::delete('contacts/{contact}', 'Organizations\Contacts\ApiContactsController@delete');
Route::get('interpellation/{itemId}/index', 'Councils\ApiInterpellationController@getIndex');
Route::get('item/{item}/show', 'Api\ItemController@show');
Route::get('item/{item}/published', 'Api\ItemController@published');
Route::get('item/{item}/voteStatus', 'Api\ItemController@voteStatus');
Route::get('councils/{organization}/index', 'Councils\ApiCouncilController@index');


Route::apiResources([
    'vote' => 'Api\VoteController',
    'item' => 'Api\ItemController',
]);
