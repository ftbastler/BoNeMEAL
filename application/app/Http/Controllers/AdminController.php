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

			$servers = \App\Server::get();
			$newAccounts = \App\User::needActivation()->count();
			$activePlayers = [];

			$outdatedServers = [];

			$activeBans = 0;
			$activeMutes = 0;
			$numPlayers = 0;
			$numBans = 0;
			$numMutes = 0;
			$numWarnings = 0;
			$numKicks = 0;
			$numNotes = 0;

			foreach(\App\Server::get() as $server) {

				$activeBans += \App\PlayerBan::on($server->id)->active()->count();
				$activeMutes += \App\PlayerMute::on($server->id)->active()->count();
				array_push($activePlayers,
					\App\Player::on($server->id)
					->where('lastSeen', '>=', strtotime("-30 days"))
					->where('lastSeen', '<=', strtotime("now"))
					->selectRaw("count(*) as total_players, FROM_UNIXTIME(lastSeen, '%Y-%m-%d') as 'day'")
					->groupBy('day')
					->lists('total_players', 'day')
				);

				$numPlayers += \App\Player::on($server->id)->count();
				$numBans += \App\PlayerBan::on($server->id)->count();
				$numBans += \App\PlayerBanRecord::on($server->id)->count();
				$numMutes += \App\PlayerMute::on($server->id)->count();
				$numMutes += \App\PlayerMuteRecord::on($server->id)->count();
				$numWarnings += \App\PlayerWarning::on($server->id)->count();
				$numKicks += \App\PlayerKick::on($server->id)->count();
				$numNotes += \App\PlayerNote::on($server->id)->count();

				if(\App\PlayerBan::on($server->id)->outdated()->count() > 0)
					array_push($outdatedServers, $server->name);
				elseif(\App\PlayerMute::on($server->id)->outdated()->count() > 0)
					array_push($outdatedServers, $server->name);

			}

			$lastSeenStats = array();

			for($i=30; $i>=0; $i--) {
				$date = \Carbon\Carbon::now()->subDays($i);
				$lastSeenStats[$date->formatLocalized('%d %B')] = array_sum(array_column($activePlayers, $date->format('Y-m-d'))) ?: 0;
			}

			return compact('activeMutes', 'activeBans', 'newAccounts', 'numPlayers', 'servers', 'outdatedServers', 'lastSeenStats', 'numBans', 'numMutes', 'numKicks', 'numWarnings', 'numNotes');
		});

		return view('admin.index', $data, $this->fetchActivity());
	}

	public function activeBans()
	{
		$data = \Cache::remember('activeBansData', 1, function() {
			$activeItems = collect();
			foreach(\App\Server::get() as $server) {
				$activeItems = $activeItems->merge(\App\PlayerBan::on($server->id)->with('actor','player')->active()->get());
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
				$activeItems = $activeItems->merge(\App\PlayerMute::on($server->id)->with('actor','player')->active()->get());
			}
			$title = trans('app.activeMutes');
			return compact('activeItems', 'title');
		});

		return view('admin.activePunishments', $data);
	}

	public function activeWarnings()
	{
		$data = \Cache::remember('activeWarningsData', 1, function() {
			$activeItems = collect();
			foreach(\App\Server::get() as $server) {
				$activeItems = $activeItems->merge(\App\PlayerWarning::on($server->id)->with('actor','player')->active()->get());
			}
			$title = trans('app.activeWarnings');
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
				$recentBans = $recentBans->merge(\App\PlayerBan::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentBanRecords = $recentBanRecords->merge(\App\PlayerBanRecord::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentMutes = $recentMutes->merge(\App\PlayerMute::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentMuteRecords = $recentMuteRecords->merge(\App\PlayerMuteRecord::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentKicks = $recentKicks->merge(\App\PlayerKick::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentNotes = $recentNotes->merge(\App\PlayerNote::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
				$recentWarnings = $recentWarnings->merge(\App\PlayerWarning::on($server->id)->with('player')->orderBy('created', 'desc')->take(25)->get());
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
