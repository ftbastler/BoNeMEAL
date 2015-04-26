<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlayerController extends Controller {

	public function index()
	{
		//return redirect('/');
	}

	public function show($name)
	{
		$player = \App\Player::where('name', $name)->first();

		if(!$player)
			abort(404, 'A player with that name does not exist.');

		$bans = $player->bans;
		
		$activeBans = $player->bans()->active()->get();
		$activeMutes = $player->mutes()->active()->get();

		$mutes = $player->mutes;
		$kicks = $player->kicks;
		$warnings = $player->warnings;

		$pastBans = $player->pastBans;
		$pastMutes = $player->pastMutes;

		$activity = collect()->merge($bans)->merge($mutes)->merge($kicks)->merge($warnings)->merge($pastBans)->merge($pastMutes);

		$activity->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		return view('player', compact('player', 'activity', 'bans', 'activeBans', 'mutes', 'activeMutes', 'kicks', 'warnings', 'pastBans', 'pastMutes'));
	}

	public function search(Request $request) {
		$query = $request->input('playername');

		$player = \App\Player::where('name', $query)->get();

		if(count($player) < 1) {
			Session::flash('error', trans('app.playerNotFound'));
			return redirect('/')->withInput();
		}

		return redirect('/player/'.$query);
	}

}
