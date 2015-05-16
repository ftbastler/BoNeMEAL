<?php namespace App\Http\Controllers;

class StatsController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
	}

	public function index()
	{
		$data = \Cache::remember('statsData', 10, function() {
			$servers = \App\Server::get();
			$players = null;
			$activeBans = null;
			$activeMutes = null;

			foreach($servers as $server) {
				$players[$server->id] = \App\Player::on($server->id)->count();
				$activeBans[$server->id] = \App\PlayerBan::on($server->id)->active()->count();
				$activeMutes[$server->id] = \App\PlayerMute::on($server->id)->active()->count();
			}

			return compact('servers', 'players', 'activeMutes', 'activeBans');
		});

		return view('stats', $data);
	}

}
