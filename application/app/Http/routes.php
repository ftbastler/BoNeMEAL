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
Route::get('/statistics', 'StatsController@index');

Route::get('/players', 'PlayerController@index');
Route::get('/players/search/{query}', 'PlayerController@search');
Route::post('/players/search', 'PlayerController@search');
Route::get('/players/{player}', 'PlayerController@show');

Route::get('/api', 'ApiController@index');
Route::get('/api/version', 'ApiController@version');
Route::get('/api/search-playername/{server?}/{query}', 'ApiController@searchPlayerName');
Route::get('/api/search-playername-all/{query}', 'ApiController@searchPlayerNameAll');

Route::group(array('prefix' => '/admin', 'middleware' => 'auth'), function() {
	Route::get('/players', 'PlayerAdminController@index');
	Route::get('/players/search', 'PlayerAdminController@search');
	Route::get('/players/{player}', 'PlayerAdminController@show');

	Route::resource('/servers', 'ServerController');
	Route::resource('/users', 'UserController');

	Route::get('/bans', 'PlayerBanController@index');
	Route::get('/bans/create/{player?}', 'PlayerBanController@create');
	Route::post('/bans', 'PlayerBanController@store');
	Route::get('/bans/{server}/{id}', 'PlayerBanController@edit');
	Route::put('/bans/{server}/{id}', 'PlayerBanController@update');
	Route::delete('/bans/{server}/{id}', 'PlayerBanController@destroy');

	Route::delete('/ban-records/{server}/{id}', 'PlayerBanRecordController@destroy');

	Route::get('/mutes', 'PlayerMuteController@index');
	Route::get('/mutes/create/{player?}', 'PlayerMuteController@create');
	Route::post('/mutes', 'PlayerMuteController@store');
	Route::get('/mutes/{server}/{id}', 'PlayerMuteController@edit');
	Route::put('/mutes/{server}/{id}', 'PlayerMuteController@update');
	Route::delete('/mutes/{server}/{id}', 'PlayerMuteController@destroy');

	Route::delete('/mute-records/{server}/{id}', 'PlayerMuteRecordController@destroy');

	Route::get('/notes', 'PlayerNoteController@index');
	Route::get('/notes/create/{player?}', 'PlayerNoteController@create');
	Route::post('/notes', 'PlayerNoteController@store');
	Route::get('/notes/{server}/{id}', 'PlayerNoteController@edit');
	Route::put('/notes/{server}/{id}', 'PlayerNoteController@update');
	Route::delete('/notes/{server}/{id}', 'PlayerNoteController@destroy');

	Route::get('/warnings', 'PlayerWarningController@index');
	Route::get('/warnings/create/{player?}', 'PlayerWarningController@create');
	Route::post('/warnings', 'PlayerWarningController@store');
	Route::get('/warnings/{server}/{id}', 'PlayerWarningController@edit');
	Route::put('/warnings/{server}/{id}', 'PlayerWarningController@update');
	Route::delete('/warnings/{server}/{id}', 'PlayerWarningController@destroy');

	Route::delete('/kicks/{server}/{id}', 'PlayerKickController@destroy');

	Route::get('/', 'AdminController@index');
	Route::get('/active-bans', 'AdminController@activeBans');
	Route::get('/active-mutes', 'AdminController@activeMutes');
	Route::get('/active-warnings', 'AdminController@activeWarnings');

	Route::get('/flush-cache', 'AdminController@flushCache');
	Route::get('/activity', 'AdminController@activity');

	Route::get('/config', 'ConfigurationController@index');
	Route::post('/config', 'ConfigurationController@update');
});

Route::group(array('prefix' => '/install', 'middleware' => 'install'), function() {
	Route::get('/', 'InstallController@index');
	Route::get('/config', 'InstallController@config');
	Route::post('/run', 'InstallController@install');
	Route::get('/finish', 'InstallController@finish');
});

Route::get('/home', function() {
	return redirect('/');
});

Route::controllers([
	'/auth/password' => 'Auth\PasswordController',
	'/auth' => 'Auth\AuthController',
]);

Route::bind('player', function($value)
{
	$id = uuid_to_id($value);
	$player = [];

	foreach(\App\Server::get() as $server) {
		$item = \App\Player::on($server->id)->find($id);
		if($item) array_push($player, $item);
	}

	if(count($player) <= 0)
		abort(404, 'Player not found.');
	
	return $player;
});

Route::bind('server', function($value)
{
	$server = \App\Server::find((int) $value);
	if(!$server) abort(404, 'Server not found.');

	return $server;
});
