<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ServerController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('superuser');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$servers = \App\Server::get();
		return view('admin.servers.index', compact('servers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.servers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'       => 'required|min:3|unique:servers',
			'db_host'      => 'required',
			'db_username'      => 'required',
			'db_password'      => 'required',
			'db_database'		=> 'required',
			'db_prefix'      => '',
			);
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return \Redirect::to('/admin/servers/create')
			->withErrors($validator)
			->withInput(\Input::except('db_password'));
		} else {
			$connect = @mysqli_connect(\Input::get('db_host'), \Input::get('db_username'), \Input::get('db_password'), \Input::get('db_database'));
			
			if(!$connect || mysqli_connect_errno()) {
				\Session::flash('message', trans('app.dbNotConnect'));
				\Session::flash('messageDetails', mysqli_connect_error());
				return redirect('/admin/servers/create')->withInput();
			}

			$query = mysqli_query($connect, 'SHOW TABLES LIKE "'.\Input::get('db_prefix').'players"');

			if(!$query || mysqli_num_rows($query) <= 0) {
				\Session::flash('message', trans('app.missingDbTables'));
				return redirect('/admin/servers/create')->withInput();
			}

			$server = new \App\Server;
			$server->name       = \Input::get('name');
			$server->db_host      = \Input::get('db_host');
			$server->db_username = \Input::get('db_username');
			$server->db_password = \Input::get('db_password');
			$server->db_database = \Input::get('db_database');
			$server->db_prefix = \Input::get('db_prefix');
			$server->save();

			\Session::flash('message', trans('app.createdServer'));
			return \Redirect::to('/admin/servers');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$server = \App\Server::findOrFail($id);
		return view('admin.servers.edit', compact('server'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name'       => 'required|min:3|unique:servers,name,'.$id,
			'db_host'      => 'required',
			'db_username'      => 'required',
			'db_password'      => 'required',
			'db_database'		=> 'required',
			'db_prefix'      => '',
			);
		$validator = \Validator::make(\Input::all(), $rules);

		if ($validator->fails()) {
			return redirect('/admin/servers/'.$id.'/edit')
			->withErrors($validator);
		} else {
			$connect = @mysqli_connect(\Input::get('db_host'), \Input::get('db_username'), \Input::get('db_password'), \Input::get('db_database'));
			
			if(!$connect || mysqli_connect_errno()) {
				\Session::flash('message', trans('app.dbNotConnect'));
				\Session::flash('messageDetails', mysqli_connect_error());
				return redirect('/admin/servers/'.$id.'/edit')->withInput();
			}

			$query = mysqli_query($connect, 'SHOW TABLES LIKE "'.\Input::get('db_prefix').'players"');

			if(!$query || mysqli_num_rows($query) <= 0) {
				\Session::flash('message', trans('app.missingDbTables'));
				return redirect('/admin/servers/'.$id.'/edit')->withInput();
			}

			$server = \App\Server::findOrFail($id);
			$server->name       = \Input::get('name');
			$server->db_host      = \Input::get('db_host');
			$server->db_username = \Input::get('db_username');
			$server->db_password = \Input::get('db_password');
			$server->db_database = \Input::get('db_database');
			$server->db_prefix = \Input::get('db_prefix');
			$server->save();

			\Session::flash('message', trans('app.updatedServer'));
			return \Redirect::to('/admin/servers');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$server = \App\Server::findOrFail($id);
		$server->delete();

		\Session::flash('message', trans('app.removedServer'));
		return \Redirect::to('/admin/servers');
	}

}
