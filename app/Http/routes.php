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

Route::get('/', 'StaticPageController@index');
Route::get('about', 'StaticPageController@about');

Route::get('player', 'PlayerController@index');
Route::get('player/search', 'PlayerController@search');
Route::get('player/{name}', 'PlayerController@show');

Route::get('admin/player', 'ManageController@index');
Route::get('admin/player/search', 'ManageController@search');
Route::get('admin/player/{name}', 'ManageController@show');

Route::get('admin', 'AdminController@index');
Route::get('admin/active-bans', 'AdminController@activeBans');
Route::get('admin/active-mutes', 'AdminController@activeMutes');
Route::get('admin/players', 'AdminController@showPlayers');

Route::get('home', function() {
	return Redirect::to('/');
});

Route::controllers([
	'auth/password' => 'Auth\PasswordController',
	'auth' => 'Auth\AuthController',
]);
