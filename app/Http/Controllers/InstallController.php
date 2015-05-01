<?php namespace App\Http\Controllers;

class InstallController extends Controller {

	public function __construct()
	{
		$this->middleware('install');
	}

	public function index()
	{	
		return view('install.index');
	}

	public function config()
	{	
		$host  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		$host .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";

		$secKey = $this->generateSecretKey(32);

		return view('install.config', compact('host', 'secKey'));
	}

	public function install() {
		$rules = [
		'host' => 'required|url',
		'locale' => 'required',
		'timezone' => 'required',
		'key' => 'required|min:32|max:32',

		'name' => 'required|max:255',
		'email' => 'required|email|max:255|unique:users',
		'password' => 'required|confirmed|min:6',
		];

		$validator = \Validator::make(\Input::all(), $rules);

		if($validator->fails()) {
			return redirect('/install/config')
			->withErrors($validator)
			->withInput(\Input::except('password'));
		}

		echo view('install.run');

		try {
			define('STDIN', fopen("php://stdin","r"));

			\Artisan::call('migrate:install');
			\Artisan::call('migrate', [
				'--path' => 'database/migrations'
				]);
		} catch(\Exception $e) {
			echo '<script>$("#output").append(\'Error while installing application: '.$e->getMessage().'<br /><br />Please go back and try again or report this bug to our issue tracker.\');</script>';
			return;
		}

		$user = new \App\User;
		$user->name = \Input::get('name');
		$user->password = bcrypt(\Input::get('password'));
		$user->email = \Input::get('email');
		$user->role = 8; // = superuser
		$user->save();

		$env = "";
		$env .= "# The application's locale.";
		$env .= PHP_EOL;
		$env .= "APP_LOCALE=" . \Input::get('locale');
		$env .= PHP_EOL . PHP_EOL;

		$env .= "# The application's timezone.";
		$env .= PHP_EOL;
		$env .= "APP_TIMEZONE=" . \Input::get('timezone');
		$env .= PHP_EOL . PHP_EOL;

		$env .= "# The application's base url. No trailing slash! Remember to change it in your public/.htaccess file as well.";
		$env .= PHP_EOL;
		$env .= "APP_URL=" . \Input::get('host');
		$env .= PHP_EOL . PHP_EOL;

		$env .= "# The application's secret key (Do not give it away!).";
		$env .= PHP_EOL;
		$env .= "APP_KEY=" . \Input::get('key');

		file_put_contents(base_path() . DIRECTORY_SEPARATOR . '.env', $env);

		return '<script>window.location = "'.url('/install/finish').'";</script>';
	}

	public function finish() {
		file_put_contents(base_path() . DIRECTORY_SEPARATOR . 'installed.lock', time() ?: 1);
		return view('install.finish');
	}

	private function generateSecretKey($total_lenght) {
		$output_code = NULL;
		$total_lenght - 1;
		$part = 1;
		$code = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
		while ($part <= $total_lenght) {
			$output_code .= $code[rand(0,61)];
			$part ++;
		}
		return $output_code;
	}

}