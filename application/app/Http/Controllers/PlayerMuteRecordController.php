<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerMuteRecordController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('admin');
		$this->middleware('servers');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($server, $id)
	{
		$mute = \App\PlayerMuteRecord::on($server->id)->findOrFail($id);

		$mute->delete();

		\Session::flash('message', trans('app.removedMuteRecord'));
		return redirect('/admin');
	}

}
