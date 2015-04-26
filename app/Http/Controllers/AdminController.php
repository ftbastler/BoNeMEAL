<?php namespace App\Http\Controllers;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function index()
	{
		$activeBans = \App\PlayerBan::active()->get();
		$activeMutes = \App\PlayerMute::active()->get();

		$players = \App\Player::get();

		$mutes = \App\PlayerMute::orderBy('created')->take(25)->get();
		$kicks = \App\PlayerKick::orderBy('created')->take(25)->get();
		$notes = \App\PlayerNote::orderBy('created')->take(25)->get();
		$warnings = \App\PlayerWarning::orderBy('created')->take(25)->get();

		return view('admin.index', compact('activeMutes', 'activeBans', 'mutes', 'kicks', 'notes', 'warnings', 'players'));
	}

	public function activeBans()
	{
		$activeItems = \App\PlayerBan::active()->get();
		$title = trans('app.activeBans');
		return view('admin.activePunishments', compact('activeItems', 'title'));
	}

	public function activeMutes()
	{
		$activeItems = \App\PlayerMute::active()->get();
		$title = trans('app.activeMutes');
		return view('admin.activePunishments', compact('activeItems', 'title'));
	}

	public function showPlayers()
	{
		$players = \App\Player::get();
		return view('admin.players', compact('players'));
	}

}
