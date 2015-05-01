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
Route::get('/about', 'StaticPageController@about');

Route::get('/players', 'PlayerController@index');
Route::get('/players/search', 'PlayerController@search');
Route::get('/players/{player}', 'PlayerController@show');

Route::group(array('prefix' => '/admin', 'middleware' => 'auth'), function() {
	Route::get('/players', 'PlayerAdminController@index');
	Route::get('/players/search', 'PlayerAdminController@search');
	Route::get('/players/{player}', 'PlayerAdminController@show');
	Route::get('/players/{player}/ban', 'PlayerAdminController@banPlayer');
	Route::get('/players/{player}/mute', 'PlayerAdminController@mutePlayer');
	Route::get('/players/{player}/warn', 'PlayerAdminController@warnPlayer');
	Route::get('/players/{player}/note', 'PlayerAdminController@notePlayer');

	Route::resource('/servers', 'ServerController');
	Route::resource('/users', 'UserController');

	Route::get('/', 'AdminController@index');
	Route::get('/active-bans', 'AdminController@activeBans');
	Route::get('/active-mutes', 'AdminController@activeMutes');
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

		if($item)
			array_push($player, $item);
	}

	if(count($player) < 0)
		abort(404);
	
	return $player;
});

/*
Route::bind('server', function($value)
{
	$value = str_replace('s', '', $value);
	$server = \App\Server::find((int) $value);

	if(!$server)
		abort(404, 'Can not find specific server.');

	\Config::set('database.default', 's'.$server->id);
	\Session::flash('server', $server);

	return $server;
});
*/
