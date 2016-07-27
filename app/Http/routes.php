<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
// 	return view('index');
// });
Route::get('/index', 'IndexController@showIndex');
// // Authentication routes...

// Route::get('auth/login', 'Auth\AuthController@getLogin');

// Route::post('auth/login', 'Auth\AuthController@postLogin');

// Route::get('auth/logout', 'Auth\AuthController@getLogout');


// // Registration routes...

// Route::get('auth/register', 'Auth\AuthController@getRegister');

// Route::post('auth/register', 'Auth\AuthController@postRegister');


// // Password reset link request routes...

// Route::get('password/email', 'Auth\PasswordController@getEmail');

// Route::post('password/email', 'Auth\PasswordController@postEmail');


// // Password reset routes...

// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');

// Route::post('password/reset', 'Auth\PasswordController@postReset');
// Route::get('/', function () {
//     return view('index', ['name' => 'Samantha']);
// });

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
	// Route::auth('users', 'UserController');


	Route::resource('users', 'UserController');
	Route::resource('annonces', 'AnnonceController');
	Route::resource('search', 'SearchController@index');
	// Route::resource('admin', 'AdminController');
	Route::resource('message', 'MessageController');
	// Route::resource('message/22/update', 'MessageController@update');
	// Route::resource('message', 'MessageController@update');

	// Route::resource('admin/user', 'AdminController@user');
	Route::get('logout', 'Auth\AuthController@getLogout');

	Route::get('register/verify/{confirmationCode}', ['as' => 'confirmation_path','uses' => 'IndexController@confirm']);
	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');
// Authentication routes...

	Route::get('/users', ['middleware' => 'auth','uses' => 'UserController@index']);
	Route::get('/search', ['middleware' => 'auth','uses' => 'SearchController@index']);

	Route::get('auth/login', 'Auth\AuthController@login');
	Route::get('/users/destroy/{id}', function ($id) {
		return 'User'.$id;

	});
	Route::get('/annonces/destroy/{id}', function ($id) {
		return 'User'.$id;

	});
	Route::get('/annonces/{id}/edit', function ($id) {
		return 'User'.$id;

	});
	Route::post('/message/{id}/update', function ($id) {
		return 'User'.$id;

	});
	// Route::post('message/read/{id}', function ($id) {
	// 	return $id;

	// });
	

	Route::get('search', 'SearchController@index');

	Route::get('annonces/store', 'AnnonceController@store');

	Route::post('admin/json', 'AdminController@json');
	Route::get('admin/json', 'AdminController@json');

	Route::get('admin/jsonuser', 'AdminController@jsonuser');
	Route::post('admin/jsonuser', 'AdminController@jsonuser');

	Route::get('admin/jsonhours', 'AdminController@jsonhours');
	Route::post('admin/jsonhours', 'AdminController@jsonhours');

	Route::get('admin/user', 'AdminController@user');
	Route::post('admin/user', 'AdminController@user');

	Route::get('admin/hours', 'AdminController@hours');
	Route::post('admin/hours', 'AdminController@hours');

	Route::get('admin', 'AdminController@index');
	Route::post('admin', 'AdminController@index');

	Route::get('message/{id}', 'MessageController@update');
	Route::post('message/{id}', 'MessageController@update');

	Route::get('message/read/{id}', 'MessageController@read');
	Route::put('message/read/{id}', 'MessageController@read');

	// Route::get('email/read', 'MessageController@read');
	// Route::post('email/read', 'MessageController@read');


	Route::post('annonces/store', 'AnnonceController@store');
	Route::get('annonces/add', 'AnnonceController@add');

	Route::post('annonces/add', 'AuthController@add');

	Route::get('annonces', 'AnnonceController@index');

	Route::post('auth/login', 'Auth\AuthController@login');

	Route::get('login', 'Auth\AuthController@getLogin');

	Route::post('login', 'Auth\AuthController@postLogin');

	Route::get('logout', 'Auth\AuthController@logout');


	Route::get('register', 'Auth\AuthController@getRegister');

	Route::post('register', 'Auth\AuthController@postRegister');


	Route::get('password/email', 'Auth\PasswordController@getEmail');

	Route::post('password/email', 'Auth\PasswordController@postEmail');



	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');

	Route::post('password/reset', 'Auth\PasswordController@postReset');

});
Route::group(['namespace' => 'Index'], function()
{

});
// Route::group(['middleware' => 'web'], function () {
//     Route::auth();

//     Route::get('/home', 'HomeController@index');
// });

// Route::group(['middleware' => 'web'], function () {
// 	Route::auth();

// 	Route::get('/home', 'HomeController@index');
// });
