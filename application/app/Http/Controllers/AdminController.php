<?php namespace App\Http\Controllers;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('mod');
		$this->middleware('servers');
	}

	public function index()
	{
		$data = \Cache::remember('dashboardData', 5, function() {
			$activeBans = collect();
			$activeMutes = collect();
			$players = collect();

			$servers = \App\Server::get();
			$newAccounts = \App\User::needActivation()->get();

			$outdatedServers = [];

			$numBans = 0;
			$numMutes = 0;
			
			foreach(\App\Server::get() as $server) {
				$activeBans = $activeBans->merge(\App\PlayerBan::on($server->id)->active()->get());
				$activeMutes = $activeMutes->merge(\App\PlayerMute::on($server->id)->active()->get());
				$players = $players->merge(\App\Player::on($server->id)->get());

				$numBans += \App\PlayerBan::on($server->id)->count();
				$numBans += \App\PlayerBanRecord::on($server->id)->count();
				$numMutes += \App\PlayerMute::on($server->id)->count();
				$numMutes += \App\PlayerMuteRecord::on($server->id)->count();

				if(\App\PlayerBan::on($server->id)->outdated()->count() > 0)
					array_push($outdatedServers, $server->name);
				elseif(\App\PlayerMute::on($server->id)->outdated()->count() > 0)
					array_push($outdatedServers, $server->name);
			}

			$playerStats = $players->unique()->filter(function($item)
			{
    			return $item->lastSeen >= \Carbon\Carbon::now()->subDays(30) && $item->lastSeen <= \Carbon\Carbon::now();
			})->groupBy(function($item) {
				return \Carbon\Carbon::parse($item->lastSeen)->format('Y-m-d');
			});

			$playerStats = $playerStats->toArray();
			$lastSeenStats = null;
			for($i=30; $i>=0; $i--) {
				$date = \Carbon\Carbon::now()->subDays($i);
				$lastSeenStats[$date->formatLocalized('%d %B')] = isset($playerStats[$date->format('Y-m-d')]) ? count($playerStats[$date->format('Y-m-d')]) : 0;
			}

			return compact('activeMutes', 'activeBans', 'newAccounts', 'players', 'servers', 'outdatedServers', 'lastSeenStats', 'numBans', 'numMutes');
		});

		return view('admin.index', $data, $this->fetchActivity());
	}

	public function activeBans()
	{
		$data = \Cache::remember('activeBansData', 1, function() {
			$activeItems = collect();
			foreach(\App\Server::get() as $server) {
				$activeItems = $activeItems->merge(\App\PlayerBan::on($server->id)->active()->get());
			}
			$title = trans('app.activeBans');
			return compact('activeItems', 'title');
		});

		return view('admin.activePunishments', $data);
	}

	public function activeMutes()
	{
		$data = \Cache::remember('activeMutesData', 1, function() {
			$activeItems = collect();
			foreach(\App\Server::get() as $server) {
				$activeItems = $activeItems->merge(\App\PlayerMute::on($server->id)->active()->get());
			}
			$title = trans('app.activeMutes');
			return compact('activeItems', 'title');
		});

		return view('admin.activePunishments', $data);
	}

	public function activity() {
		$data = $this->fetchActivity();

		return view('admin.activity', $data);
	}

	public function flushCache() {
		\Cache::flush();

		\Session::flash('message', trans('app.clearedCache'));
		return redirect('/admin');
	}

	private function fetchActivity() {
		$data = \Cache::remember('activityStreamData', 2, function() {
			$servers = \App\Server::get();

			$recentBans = collect();
			$recentMutes = collect();
			$recentKicks = collect();
			$recentWarnings = collect();
			$recentNotes = collect();
			$recentBanRecords = collect();
			$recentMuteRecords = collect();
			
			foreach(\App\Server::get() as $server) {
				$recentBans = $recentBans->merge(\App\PlayerBan::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentBanRecords = $recentBanRecords->merge(\App\PlayerBanRecord::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentMutes = $recentMutes->merge(\App\PlayerMute::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentMuteRecords = $recentMuteRecords->merge(\App\PlayerMuteRecord::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentKicks = $recentKicks->merge(\App\PlayerKick::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentNotes = $recentNotes->merge(\App\PlayerNote::on($server->id)->orderBy('created', 'desc')->take(25)->get());
				$recentWarnings = $recentWarnings->merge(\App\PlayerWarning::on($server->id)->orderBy('created', 'desc')->take(25)->get());
			}

			$activity = collect()->merge($recentBans)->merge($recentBanRecords)->merge($recentMutes)->merge($recentMuteRecords)->merge($recentKicks)->merge($recentWarnings)->merge($recentNotes);
			$activity = $activity->sortBy(function($item) {
				return -1 * $item->created->timestamp;
			})->slice(0, 10);

			$recentBans = $recentBans->sortBy(function($item) {
				return -1 * $item->created_at->timestamp;
			})->slice(0, 5);

			$recentBanRecords = $recentBanRecords->sortBy(function($item) {
				return -1 * $item->created->timestamp;
			})->slice(0, 5);

			$recentMutes = $recentMutes->sortBy(function($item) {
				return -1 * $item->created_at->timestamp;
			})->slice(0, 5);

			$recentMuteRecords = $recentMuteRecords->sortBy(function($item) {
				return -1 * $item->created->timestamp;
			})->slice(0, 5);

			$recentKicks = $recentKicks->sortBy(function($item) {
				return -1 * $item->created_at->timestamp;
			})->slice(0, 5);

			$recentWarnings = $recentWarnings->sortBy(function($item) {
				return -1 * $item->created_at->timestamp;
			})->slice(0, 5);

			$recentNotes = $recentNotes->sortBy(function($item) {
				return -1 * $item->created_at->timestamp;
			})->slice(0, 5);

			return compact('activity', 'recentMutes', 'recentBanRecords', 'recentBans', 'recentMuteRecords', 'recentKicks', 'recentWarnings', 'recentNotes');
		});

		return $data;
	}

}
