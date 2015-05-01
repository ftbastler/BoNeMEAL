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

		/*
		$mutes = \App\PlayerMute::orderBy('created')->take(25)->get();
		$kicks = \App\PlayerKick::orderBy('created')->take(25)->get();
		$notes = \App\PlayerNote::orderBy('created')->take(25)->get();
		$warnings = \App\PlayerWarning::orderBy('created')->take(25)->get();
		*/

		return view('admin.index', compact('activeMutes', 'activeBans', 'newAccounts', 'players', 'servers'));
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
