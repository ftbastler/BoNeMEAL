<?php namespace App\Http\Controllers;

class ApiController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function index()
	{
		return 'BoNeMEAL API';
	}

	public function searchPlayerName($server, $query)
	{
		$players = \App\Player::on($server->id)->where('name', 'LIKE', '%'.$query.'%')->get();
		
		$results = [];
		foreach($players as $player) {
			array_push($results, $player->name);
		}

		return array('query' => $query, 'results' => $results);
	}

	public function version() {
		$version = file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'version') ?: '';
		return $version;
	}

}
