<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerNoteController extends Controller {

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
		$data = \Cache::remember('playerNotesData', 1, function() {
			$allNotes = collect();
			foreach(\App\Server::get() as $server) {
				$allNotes = $allNotes->merge(\App\PlayerNote::on($server->id)->with('actor','player')->get());
			}
			$title = trans('app.allNotes');
			return compact('allNotes', 'title');
		});

		return view('admin.notes.index', $data);
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

		return view('admin.notes.create', compact('servers', 'player'));
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
			'message' => 'required',
			'player' => 'required',
			);

		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/notes/create')
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on(\Input::get('server'))->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/notes/create')->withInput();
			}

			$note = new \App\PlayerNote;
			$note->setConnection(\Input::get('server'));
			$note->player_id = $player->id;
			$note->actor_id = \App\Player::on(\Input::get('server'))->where('name', '=', 'Console')->firstOrFail()->id;
			$note->message = \Input::get('message');
			$note->created = Carbon::now();
			$note->save();

			\Session::flash('message', trans('app.notedPlayer'));
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
		$note = \App\PlayerNote::on($server->id)->findOrFail($id);
		return view('admin.notes.edit', compact('note', 'server'));
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
			'message' => 'required',
			'player' => 'required',
			);

		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/notes/'.$server->id.'/'.$id)
			->withErrors($validator)
			->withInput();
		} else {
			$player = \App\Player::on($server->id)->where('name', '=', \Input::get('player'))->first();

			if(!$player) {
				\Session::flash('message', trans('app.playerNotExist'));
				return redirect('/admin/notes/'.$server->id.'/'.$id)->withInput();
			}

			$note = \App\PlayerNote::on($server->id)->findOrFail($id);
			$note->player_id = $player->id;
			//$note->actor_id = \App\Player::on($server->id)->where('name', '=', 'Console')->firstOrFail()->id;
			$note->message = \Input::get('message');
			//$note->created = Carbon::now();
			$note->save();

			\Session::flash('message', trans('app.updatedNote'));
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
		$note = \App\PlayerNote::on($server->id)->findOrFail($id);
		$note->delete();

		\Session::flash('message', trans('app.removedNote'));
		return redirect('/admin');
	}

}
