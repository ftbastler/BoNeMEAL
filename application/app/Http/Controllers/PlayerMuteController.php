<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerMuteController extends Controller {

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
		return redirect('/admin/active-mutes');
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

		return view('admin.mutes.create', compact('servers', 'player'));
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
			return redirect('/admin/mutes/create')
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on(\Input::get('server'))->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/mutes/create')->withInput();
			}

			$muted = \App\PlayerMute::on(\Input::get('server'))->where('player_id', '=', $player->id)->first();

			if($muted) {
				\Session::flash('message', trans('app.playerAlreadyMuted'));
				return redirect('/admin/mutes/create')->withInput();
			}

			$mute = new \App\PlayerMute;
			$mute->setConnection(\Input::get('server'));
			$mute->player_id = $player->id;
			$mute->actor_id = \App\Player::on(\Input::get('server'))->where('name', '=', 'Console')->firstOrFail()->id;
			$mute->reason = \Input::get('reason');
			$mute->expires = \Input::get('expires') == "" ? Carbon::createFromTimeStamp(0) : Carbon::parse(\Input::get('expires'));
			$mute->created = Carbon::now();
			$mute->updated = Carbon::now();
			$mute->save();

			\Session::flash('message', trans('app.mutedPlayer'));
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
		$mute = \App\PlayerMute::on($server->id)->findOrFail($id);
		return view('admin.mutes.edit', compact('mute', 'server'));
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
			return redirect('/admin/mutes/'.$server->id.'/'.$id)
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on($server->id)->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/mutes/'.$server->id.'/'.$id)->withInput();
			}

			$mute = \App\PlayerMute::on($server->id)->findOrFail($id);
			$mute->player_id = $player->id;
			//$mute->actor_id = \App\Player::on($server->id)->where('name', '=', 'Console')->firstOrFail()->id;
			$mute->reason = \Input::get('reason');
			$mute->expires = \Input::get('expires') == "" ? Carbon::createFromTimeStamp(0) : Carbon::parse(\Input::get('expires'));
			//$mute->created = Carbon::now();
			$mute->updated = Carbon::now();
			$mute->save();

			\Session::flash('message', trans('app.updatedMute'));
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
		$mute = \App\PlayerMute::on($server->id)->findOrFail($id);
		$mute->delete();

		\Session::flash('message', trans('app.removedMute'));
		return redirect('/admin');
	}

}
