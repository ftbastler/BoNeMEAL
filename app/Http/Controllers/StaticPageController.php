<?php namespace App\Http\Controllers;

class StaticPageController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
	}

	public function index()
	{
		return view('index');
	}

	public function version() {
		return file_get_contents(base_path() . DIRECTORY_SEPARATOR . 'version') ?: null;
	}

}
