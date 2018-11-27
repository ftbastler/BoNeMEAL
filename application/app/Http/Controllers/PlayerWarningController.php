<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerWarningController extends Controller {

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
		return redirect('/admin/active-warnings');
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

		return view('admin.warnings.create', compact('servers', 'player'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'server' => 'required',
			'reason' => 'required',
			'player' => 'required',
			);
		
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/warnings/create')
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on(\Input::get('server'))->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/warnings/create')->withInput();
			}

			$warning = new \App\PlayerWarning;
			$warning->setConnection(\Input::get('server'));
			$warning->player_id = $player->id;
			$warning->actor_id = \App\Player::on(\Input::get('server'))->where('name', '=', 'Console')->firstOrFail()->id;
			$warning->reason = \Input::get('reason');
			$warning->created = Carbon::now();
			$warning->save();

			\Session::flash('message', trans('app.warnedPlayer'));
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
		$warning = \App\PlayerWarning::on($server->id)->findOrFail($id);
		return view('admin.warnings.edit', compact('warning', 'server'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($server, $id)
	{
		$rules = array(
			'reason' => 'required',
			'player' => 'required',
			);
		
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/warnings/'.$server->id.'/'.$id)
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on($server->id)->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/warnings/'.$server->id.'/'.$id)->withInput();
			}

			$warning = \App\PlayerWarning::on($server->id)->findOrFail($id);
			$warning->player_id = $player->id;
			//$warning->actor_id = \App\Player::on($server->id)->where('name', '=', 'Console')->firstOrFail()->id;
			$warning->reason = \Input::get('reason');
			//$warning->created = Carbon::now();
			$warning->save();

			\Session::flash('message', trans('app.updatedWarning'));
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
		$warning = \App\PlayerWarning::on($server->id)->findOrFail($id);
		$warning->delete();

		\Session::flash('message', trans('app.removedWarning'));
		return redirect('/admin');
	}

}
