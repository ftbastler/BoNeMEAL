<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlayerAdminController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('mod');
		$this->middleware('servers');
	}

	public function index()
	{
		$data = \Cache::remember('playerIndexData', 5, function() {
			$players = collect();
			foreach(\App\Server::get() as $server) {
				$players = $players->merge(\App\Player::on($server->id)->get());
			}

			$players = $players->unique();
			return compact('players');
		});

		return view('admin.players.index', $data);
	}

	public function show($players)
	{
		$activity = collect();
		$activeBans = collect();
		$activeMutes = collect();

		foreach($players as $player) {
			$activeBans = $activeBans->merge($player->bans()->active()->get());
			$activeMutes = $activeMutes->merge($player->mutes()->active()->get());

			$bans = $player->bans;

			$mutes = $player->mutes;
			$kicks = $player->kicks;
			$warnings = $player->warnings;
			$notes = $player->notes;

			$pastBans = $player->pastBans;
			$pastMutes = $player->pastMutes;

			$activity = $activity->merge($bans)->merge($mutes)->merge($kicks)->merge($warnings)->merge($pastBans)->merge($pastMutes)->merge($notes);
		}

		$activity->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$player = $players[0];

		return view('admin.players.show', compact('player', 'activity', 'activeBans', 'activeMutes'));
	}

	public function search(Request $request) {
		$query = $request->input('playername');

		foreach(\App\Server::get() as $server) {
			$player = \App\Player::on($server->id)->where('name', $query)->first();

			if(!$player)
				continue;

			return redirect('/admin/players/'.$player->uuid);
		}

		Session::flash('search_error', trans('app.playerNotFound'));
		return \Redirect::back()->withInput();
	}

}
