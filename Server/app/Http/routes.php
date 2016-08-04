<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/polls/{page}', function ($page) {
//
//	return Response::json([
//		//array of data
//	]);
//});


Route::get('/', function()
{
	return View::make('index');

});

Route::group(['prefix' => 'api/v1'], function()
{
	Route::group(['prefix' => 'user'], function() {
		Route::resource('/', 'UserController@all');
		Route::post('login', 'UserController@login');
	});

	Route::resource('menu', 'MenuController@all');

	Route::group(['prefix' => 'secret'], function() {
		Route::resource('/', 'SecretController@all');
	});

	Route::resource('comment', 'CommentController@all');
	Route::resource('refUniversity', 'RefUniversityController@all');
	Route::resource('media', 'MediaController@all');


});


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);