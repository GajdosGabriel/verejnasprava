<?php


Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/home', 'HomeController@redirect')->name('redirect');
Route::get('/contact', 'HomeController@contact')->name('home.contact');

Route::get('post/{id}', 'PostController@edit');
Route::get('company', 'CompaniesController@index');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');


Route::get('category/{category}', 'CategoryController@category');


Route::get('download/{filepath?}', 'UserController@download');


Route::get('pdf', 'OrderController@showPdf');


Route::group(['middleware' => 'auth'], function() {

    Route::prefix('user')->name('user.')->middleware(['checkUser'])->group(function() {
        Route::get('{user}/{name}/index',  'UserController@index')->name('index');
        Route::get('{user}/{name}/new-organization', 'UserController@newOrganization')->name('new-organization');

    });

    Route::prefix('org')->name('organization.')->middleware(['checkOrganization'])->namespace('Organizations')->group(function() {
        Route::get('{organization}/{slug}/index', 'OrganizationController@index')->name('index');
        Route::get('{organization}/{slug}/edit', 'OrganizationController@edit')->name('edit');
        Route::get('{organization}/{slug}/orders', 'OrganizationController@orders')->name('orders');
        Route::get('{organization}/{slug}/posts', 'OrganizationController@posts')->name('posts');
        Route::get('{organization}/{slug}/companies', 'OrganizationController@companies')->name('companies');
        Route::get('{organization}/{slug}/workers', 'OrganizationController@workers')->name('workers');
        Route::get('{organization}/{slug}/create', 'OrganizationController@postsCreate')->name('posts.create');
        Route::post('{user}/{name}/store', 'OrganizationController@store')->name('store');
        Route::put('{organization}/{slug}/update', 'OrganizationController@update')->name('update');
    });

    Route::name('worker.')->group(function() {
        Route::get('{user}/{name}/worker/create', 'WorkerController@index')->name('index');
        Route::post('{user}/{name}/worker/store', 'WorkerController@store')->name('store');
    });

    Route::name('post.')->group(function() {
        Route::get('{user}/{name}/post/create', 'PostController@create')->name('create');
        Route::post('{user}/{name}/store', 'PostController@store')->name('store');
    });

    Route::name('order.')->group(function() {
        Route::get('{user}/{name}/order/index', 'OrderController@index')->name('index');
        Route::get('{user}/{name}/order/create', 'OrderController@create')->name('create');
        Route::post('{user}/{name}/store/order', 'OrderController@store')->name('store');
    });


    Route::prefix('com')->name('company.')->namespace('Companies')->group(function() {
        Route::get('{organization}/{name}/company/index', 'CompaniesController@index')->name('index');
        Route::post('{organization}/{name}/company/store', 'CompaniesController@store')->name('store');
    });

    Route::name('question.')->group(function() {
        Route::get('{user}/{name}/question/index',  'QuestionsController@index')->name('index');
        Route::post('{user}/{name}/question/store',  'QuestionsController@store')->name('store');
    });









    Route::get('{user}/profil', 'UserController@userProfil')->name('user.profil');
    Route::get('{user}/company/{customer}', 'CompaniesController@editCustomer');




    Route::put('company/{customer}', 'CompaniesController@updateCustomer');
    Route::post('{user}/posts', 'PostController@store');

    Route::get('customer/{id}/delete', 'PostController@deletePost');

    Route::delete('post/{post}/delete', 'PostController@destroyPost')->name('deletepost');
    Route::get('{user}/post-edit/{post}', 'PostController@edit');
    Route::get('{user}/post-copy/{post}', 'PostController@copyPost');

    Route::get('admin/user', 'AdminController@indexUser');

    Route::put('update/{post}', 'PostController@update');

    Route::put('user/{user}', 'UserController@updateUser')->name('userupdate');

//    Route::get('email/poslat', 'AdminController@sendReportToUsers');
    Route::post('mesacnyvypis', 'AdminController@sendReportToUsers');


    Route::get('{user}/orderindex', 'OrderController@index');

    Route::get('{user}/ordershow/{order}', 'OrderController@show');
    Route::get('{user}/ordershow/{order}/pdf', 'OrderController@showPdf');



    Route::get('{user}/ordercopy/{order}', 'OrderController@copyOrder')->name('ordercopy');
    Route::get('{user}/orderedit/{order}', 'OrderController@editOrder')->name('orderedit');


    Route::put('updateorder/{order}', 'OrderController@updateOrder')->name('updateorder');
    Route::delete('deleteOrder/{order}', 'OrderController@deleteOrder')->name('deleteOrder');
    Route::patch('orderSendStatus/{order}', 'OrderController@orderSendStatus');



//    Staff
    Route::post('workernew', 'WorkerController@storeNewWorker')->name('worker.new');
    Route::delete('delete/{worker}', 'WorkerController@destroy');


//Order Create
    Route::get('gabriel-gajdos-reprezent/customers/zak', function() {
        $companies = \DB::table('companies')->where('user_id', Auth::id())->get();
        return response()->json($companies);
    });

});


Route::get('{user}/{category?}', 'UserController@show');

Auth::routes();


Route::get('email', function() {
    \Mail::to('gajdosgabo@gmail.com')->send(new App\Mail\NewUser());
});


Route::get('pokus/pokus', function() {
    $posts = \App\Post::all()->take(10);

    $post = $posts->map(function($post){
    return str_word_count($post->name);

    });

    return $post;

});
