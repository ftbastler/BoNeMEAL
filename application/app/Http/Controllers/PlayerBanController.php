<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerBanController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('admin');
		$this->middleware('servers');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return redirect('/admin/active-bans');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($player = null)
	{
		if($player == null)
			unset($player);
		else
			$player = $player[0];

		foreach(\App\Server::get() as $server) {
			$servers[$server->id] = $server->name;
		}

		return view('admin.bans.create', compact('servers', 'player'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		\Validator::extend('future', function($attribute, $value, $parameters)
		{
			return $value == "" || Carbon::parse($value)->isFuture();
		});

		$rules = array(
			'server' => 'required',
			'reason' => 'required',
			'player' => 'required',
			'expires' => 'future'
			);
		
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/bans/create')
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on(\Input::get('server'))->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/bans/create')->withInput();
			}

			$banned = \App\PlayerBan::on(\Input::get('server'))->where('player_id', '=', $player->id)->first();

			if($banned) {
				\Session::flash('message', trans('app.playerAlreadyBanned'));
				return redirect('/admin/bans/create')->withInput();
			}

			$ban = new \App\PlayerBan;
			$ban->setConnection(\Input::get('server'));
			$ban->player_id = $player->id;
			$ban->actor_id = \App\Player::on(\Input::get('server'))->where('name', '=', 'Console')->firstOrFail()->id;
			$ban->reason = \Input::get('reason');
			$ban->expires = \Input::get('expires') == "" ? Carbon::createFromTimeStamp(0) : Carbon::parse(\Input::get('expires'));
			$ban->created = Carbon::now();
			$ban->updated = Carbon::now();
			$ban->save();

			\Session::flash('message', trans('app.bannedPlayer'));
			return redirect('/admin/players/'.$player->uuid);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($server, $id)
	{
		abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($server, $id)
	{
		$ban = \App\PlayerBan::on($server->id)->findOrFail($id);
		return view('admin.bans.edit', compact('ban', 'server'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($server, $id)
	{
		\Validator::extend('future', function($attribute, $value, $parameters)
		{
			return $value == "" || Carbon::parse($value)->isFuture();
		});

		$rules = array(
			'reason' => 'required',
			'player' => 'required',
			'expires' => 'future'
			);
		
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/bans/'.$server->id.'/'.$id)
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on($server->id)->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/bans/'.$server->id.'/'.$id)->withInput();
			}

			$ban = \App\PlayerBan::on($server->id)->findOrFail($id);
			$ban->player_id = $player->id;
			//$ban->actor_id = \App\Player::on($server->id)->where('name', '=', 'Console')->firstOrFail()->id;
			$ban->reason = \Input::get('reason');
			$ban->expires = \Input::get('expires') == "" ? Carbon::createFromTimeStamp(0) : Carbon::parse(\Input::get('expires'));
			//$ban->created = Carbon::now();
			$ban->updated = Carbon::now();
			$ban->save();

			\Session::flash('message', trans('app.updatedBan'));
			return redirect('/admin/players/'.$player->uuid);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($server, $id)
	{
		$ban = \App\PlayerBan::on($server->id)->findOrFail($id);
		$ban->delete();

		\Session::flash('message', trans('app.removedBan'));
		return redirect('/admin');
	}

}
