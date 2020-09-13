<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class PlayerBanRecordController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('admin');
		$this->middleware('servers');
		$this->middleware('ssl');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($server, $id)
	{
		$ban = \App\PlayerBanRecord::on($server->id)->findOrFail($id);

		$ban->delete();

		\Session::flash('message', trans('app.removedBanRecord'));
		return redirect('/admin');
	}

}
