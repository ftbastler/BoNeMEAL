<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Carbon\Carbon;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Carbon::setLocale(config('app.locale'));
		setlocale(LC_ALL, config('app.locale'));

		if (\Config::get('database.default') === 'local') {
			$path = \Config::get('database.connections.local.database');
			if (!file_exists($path) && is_dir(dirname($path))) {
				touch($path);
			}
		}

		if(\Schema::connection('local')->hasTable('servers')) {
			$servers = \App\Server::get();

			$ids = [];
			foreach ($servers as $server) {
				\Config::set('database.connections.'.$server->id.'.driver', 'mysql');
				\Config::set('database.connections.'.$server->id.'.host', $server->db_host);
				\Config::set('database.connections.'.$server->id.'.database', $server->db_database);
				\Config::set('database.connections.'.$server->id.'.username', $server->db_username);
				\Config::set('database.connections.'.$server->id.'.password', $server->db_password);
				\Config::set('database.connections.'.$server->id.'.collation', 'utf8_unicode_ci');
				\Config::set('database.connections.'.$server->id.'.charset', 'utf8');
				\Config::set('database.connections.'.$server->id.'.strict', false);
				\Config::set('database.connections.'.$server->id.'.prefix', $server->db_prefix);

				array_push($ids, 's'.$server->id);
			}

			//\Config::set('servers', $ids);
		}
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
			);
	}

}
