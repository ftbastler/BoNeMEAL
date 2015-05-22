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

			$numBans = 0;
			$numMutes = 0;
			$numKicks = 0;
			$numWarnings = 0;
			$numIpBans = 0;

			foreach($servers as $server) {
				$players[$server->id] = \App\Player::on($server->id)->count();
				$activeBans[$server->id] = \App\PlayerBan::on($server->id)->active()->count();
				$activeMutes[$server->id] = \App\PlayerMute::on($server->id)->active()->count();

				$numBans += \App\PlayerBan::on($server->id)->count();
				$numBans += \App\PlayerBanRecord::on($server->id)->count();
				$numMutes += \App\PlayerMute::on($server->id)->count();
				$numMutes += \App\PlayerMuteRecord::on($server->id)->count();
				$numKicks += \App\PlayerKick::on($server->id)->count();
				$numWarnings += \App\PlayerWarning::on($server->id)->count();
				$numIpBans += \App\IpBan::on($server->id)->count();
				$numIpBans += \App\IpBanRecord::on($server->id)->count();
			}

			$nums = compact('numBans', 'numMutes', 'numKicks', 'numWarnings', 'numIpBans');

			return compact('servers', 'players', 'activeMutes', 'activeBans', 'nums');
		});

		return view('stats', $data);
	}

}
