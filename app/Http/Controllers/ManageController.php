<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function index()
	{
		return redirect('/admin');
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
		$notes = $player->notes;
		$warnings = $player->warnings;

		$pastBans = $player->pastBans;
		$pastMutes = $player->pastMutes;

		$activity = collect()->merge($bans)->merge($mutes)->merge($kicks)->merge($notes)->merge($warnings)->merge($pastBans)->merge($pastMutes);

		$activity->sortBy(function($item) {
			return -1 * $item->created_at->timestamp;
		});

		return view('admin.player', compact('player', 'activity', 'bans', 'activeBans', 'mutes', 'activeMutes', 'kicks', 'notes', 'warnings', 'pastBans', 'pastMutes'));
	}

	public function search(Request $request) {
		$query = $request->input('playername');

		$player = \App\Player::where('name', $query)->get();

		if(count($player) < 1) {
			Session::flash('search_error', trans('app.playerNotFound'));
			return redirect('/admin')->withInput();
		}

		return redirect('/admin/player/'.$query);
	}

}
