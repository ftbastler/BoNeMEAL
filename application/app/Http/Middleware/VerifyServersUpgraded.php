<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class VerifyServersUpgraded {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        if(!Schema::hasColumn('servers', 'db_ssl')) //check whether servers table has the db_ssl column
        {
            try {
                Artisan::call('migrate');
            } catch(\Exception $e) {

            }
        }

		return $next($request);
	}

}
