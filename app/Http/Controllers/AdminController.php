<?php namespace App\Http\Controllers;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('mod');
	}

	public function index()
	{	
		$activeBans = collect();
		$activeMutes = collect();
		$players = collect();

		foreach(\App\Server::get() as $server) {
			$activeBans = $activeBans->merge(\App\PlayerBan::on($server->id)->active()->get());
			$activeMutes = $activeMutes->merge(\App\PlayerMute::on($server->id)->active()->get());
			$players = $players->merge(\App\Player::on($server->id)->get());
		}

		$servers = \App\Server::get();

		$newAccounts = \App\User::needActivation()->get();

		$recentBans = collect();
		$recentMutes = collect();
		$recentKicks = collect();
		$recentWarnings = collect();
		$recentNotes = collect();

		foreach(\App\Server::get() as $server) {
			$recentBans = $recentBans->merge(\App\PlayerBan::on($server->id)->orderBy('created')->take(5)->get());
			$recentMutes = $recentMutes->merge(\App\PlayerMute::on($server->id)->orderBy('created')->take(5)->get());
			$recentKicks = $recentKicks->merge(\App\PlayerKick::on($server->id)->orderBy('created')->take(5)->get());
			$recentNotes = $recentNotes->merge(\App\PlayerNote::on($server->id)->orderBy('created')->take(5)->get());
			$recentWarnings = $recentWarnings->merge(\App\PlayerWarning::on($server->id)->orderBy('created')->take(5)->get());
		}

		$recentBans->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$recentMutes->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$recentKicks->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$recentWarnings->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$recentNotes->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		return view('admin.index', compact('activeMutes', 'activeBans', 'newAccounts', 'players', 'servers', 'recentBans', 'recentMutes', 'recentKicks', 'recentWarnings', 'recentNotes'));
	}

	public function activeBans()
	{
		$activeItems = collect();
		foreach(\App\Server::get() as $server) {
			$activeItems = $activeItems->merge(\App\PlayerBan::on($server->id)->active()->get());
		}
		$title = trans('app.activeBans');
		return view('admin.activePunishments', compact('activeItems', 'title'));
	}

	public function activeMutes()
	{
		$activeItems = collect();
		foreach(\App\Server::get() as $server) {
			$activeItems = $activeItems->merge(\App\PlayerMute::on($server->id)->active()->get());
		}
		$title = trans('app.activeMutes');
		return view('admin.activePunishments', compact('activeItems', 'title'));
	}

}
