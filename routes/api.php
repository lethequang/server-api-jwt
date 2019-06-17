<?php

use Illuminate\Support\Facades\App;
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

// Set locale Vietnam
App::setLocale('vi');

Route::post('auth/login', 'AuthController@login');

Route::group([
	'middleware' => 'jwt',
], function () {

	Route::group(['prefix' => 'auth'], function() {
		Route::post('logout', 'AuthController@logout');
		Route::post('refresh', 'AuthController@refresh');
		Route::post('me', 'AuthController@me');
	});

	Route::group(['prefix' => 'user'], function() {
		Route::get('/show-all', 'UserController@showAll');
		Route::get('/detail/{id}', 'UserController@detail');
		Route::delete('/remove/{id}', 'UserController@remove');
		Route::put('/update/{id}', 'UserController@update');
		Route::post('/create', 'UserController@create');
	});

	Route::group(['prefix' => 'invoice'], function() {
		Route::delete('/remove/{id}', 'InvoiceController@remove');
		Route::post('/create', 'InvoiceController@create');
	});
});