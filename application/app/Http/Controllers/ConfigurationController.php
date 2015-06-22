<?php namespace App\Http\Controllers;

class ConfigurationController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('admin');
	}

	public function index()
	{	
		$env = file_get_contents(base_path() . DIRECTORY_SEPARATOR . '.env');

		return view('admin.config');
	}

	public function update()
	{	
		$rules = [
		'locale' => 'required',
		'timezone' => 'required',
		];

		$validator = \Validator::make(\Input::all(), $rules);

		if($validator->fails()) {
			return redirect('/admin/config')
			->withErrors($validator)
			->withInput(\Input::all());
		}

		$env = file_get_contents(base_path() . DIRECTORY_SEPARATOR . '.env');

		\Session::flash('message', "Sorry, this is still WIP. Settings were NOT saved.");
		return redirect('/admin/config');

		/*
		$re1='(APP)';	# Word 1
		$re2='(_)';	# Any Single Character 1
		$re3='(LOCALE)';	# Word 2
		$re4='(=)';	# Any Single Character 2
		$re5='((?:[a-z][a-z0-9_]*))';	# Variable Name 1

		if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $env, $matches))
		{
			$var1=$matches[5][0];
			$env = str_replace('APP_LOCALE='.$var1, 'APP_LOCALE='.\Input::get('locale'), $env);
		}

		$re1='(APP)';	# Word 1
		$re2='(_)';	# Any Single Character 1
		$re3='(TIMEZONE)';	# Word 2
		$re4='(=)';	# Any Single Character 2
		$re5='((?:[a-z][a-z0-9_]*))';	# Variable Name 1

		if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $env, $matches))
		{
			$var1=$matches[5][0];
			$env = str_replace('APP_TIMEZONE='.$var1, 'APP_TIMEZONE='.\Input::get('timezone'), $env);
		}
		*/

		file_put_contents(base_path() . DIRECTORY_SEPARATOR . '.env', $env);

		\Session::flash('message', trans('app.savedSettings'));
		return redirect('/admin/config');
	}

}