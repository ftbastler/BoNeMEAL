<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlayerController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
	}

	public function index()
	{
		$players = \App\Player::get();
		dd($players);
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

			$pastBans = $player->pastBans;
			$pastMutes = $player->pastMutes;

			$activity = $activity->merge($bans)->merge($mutes)->merge($kicks)->merge($warnings)->merge($pastBans)->merge($pastMutes);
		}

		$activity->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		$player = $players[0];

		return view('player', compact('player', 'activeBans', 'activeMutes', 'activity'));
	}

	public function search(Request $request) {
		$query = $request->input('playername');

		foreach(\App\Server::get() as $server) {
			$player = \App\Player::on($server->id)->where('name', $query)->first();

			if(!$player)
				continue;

			return redirect('/players/'.$player->uuid);
		}

		Session::flash('error', trans('app.playerNotFound'));
		return redirect('/')->withInput();
	}

}
