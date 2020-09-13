<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Server;

class ServerController extends Controller {

	public function __construct()
	{
		$this->middleware('installed');
		$this->middleware('auth');
		$this->middleware('superuser');
		$this->middleware('ssl');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$servers = Server::get();
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
     * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{

        $this->validate( $request, [
			'name'       => 'required|min:3|unique:servers',
			'db_host'      => 'required',
            'db_port'       => 'required|integer',
            'db_username'      => 'required',
            'db_password'      => 'required',
            'db_database'		=> 'required',
            'db_prefix'      => '',
            'db_ssl' => 'required_with:ssl.db_ca,ssl.db_cert,ssl.db_key',
            'ssl.db_ca' => 'sometimes|mimes:pem,txt',
            'ssl.db_cert' => 'required_with:db_ssl,ssl.db_key|mimes:pem,txt',
            'ssl.db_key' => 'required_with:db_ssl,ssl.db_cert|mimes:pem,txt',
        ]);

		// Upload cert files if they exist
        $certs = array();
        foreach ($request->file('ssl') as $key => $file) {
            $certs[$key] = null; // Set key unless successful upload to avoid undefined index error
            if ($request->hasFile('ssl.'.$key) && $file->isValid()) {
                $filename = str_slug($request->name . '-' . $key, '-') . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('app'), $filename);
                $certs[$key] = storage_path('app/' . $filename); // Save file name for database storage
            }
        }

		// Test connection to server before saving
        $connect = mysqli_init();

        if($request->db_ssl) { // Initialize connection for SSL
            $connect->ssl_set(
                (isset($certs['db_key']) ? $certs['db_key'] : null),
                (isset($certs['db_cert']) ? $certs['db_cert'] : null),
                (isset($certs['db_ca']) ? $certs['db_ca'] : null),
                null,
                null
            );
        }

        try{
            $connect->real_connect($request->db_host, $request->db_username, $request->db_password, $request->db_database, $request->db_port, null, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
        } catch (\ErrorException $e) {
            return redirect()->route('admin.servers.create')->withInput()->with('message', trans('app.dbNotConnect'))->with('messageDetails', mysqli_connect_error());
        }

        $prefix = $connect->real_escape_string($request->db_prefix);
		$query = $connect->query('SHOW TABLES LIKE "' . $prefix . 'players"');

        if(!$query || mysqli_num_rows($query) <= 0) {
            return redirect()->route('admin.servers.create')->withInput()->with('message', trans('app.missingDbTables'));
        }

        $server = new Server;
        $server->name       = $request->name;
        $server->db_host      = $request->db_host;
        $server->db_port      = $request->db_port;
        $server->db_username = $request->db_username;
        $server->db_password = $request->db_password;
        $server->db_database = $request->db_database;
        $server->db_prefix = $request->db_prefix;
        if($request->db_ssl) {
            $server->db_ssl = true;
            $server->db_ca = $certs['db_ca'];
            $server->db_key = $certs['db_key'];
            $server->db_cert = $certs['db_cert'];
        }
        $server->save();

        \Cache::flush();

        return redirect()->route('admin.servers.index')->with('message',trans('app.createdServer'));
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
	 * @param  int $id
	 * @return Response
	 */
	public function edit($id)
	{
		$server = Server::findOrFail($id);
		return view('admin.servers.edit', compact('server'));
	}

	/**
	 * Update the specified resource in storage.
	 *
     * @param Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	    $this->validate( $request, [
            'name'       => 'required|min:3|unique:servers,' . $id,
            'db_host'      => 'required',
            'db_port'       => 'required|integer',
            'db_username'      => 'required',
            'db_password'      => 'required',
            'db_database'		=> 'required',
            'db_prefix'      => '',
            'db_ssl' => 'required_with:ssl.db_ca,ssl.db_cert,ssl.db_key',
        ]);

	    $ssl_validations = array();

        if($request->hasFile('ssl.db_ca')) {
            $ssl_validations['ssl.db_ca'] = 'sometimes|mimes:pem,txt';
        }

        if($request->hasFile('ssl.db_cert')) {
            $ssl_validations['ssl.db_cert'] = 'required_with:db_ssl,ssl.db_key|mimes:pem,txt';
        }

        if($request->hasFile('ssl.db_key')) {
            $ssl_validations['ssl.db_key'] = 'required_with:db_ssl,ssl.db_cert|mimes:pem,txt';
        }

        $this->validate($request, $ssl_validations);

        // Upload cert files if they exist
        $certs = array();
        foreach ($request->file('ssl') as $key => $file) {
            if ($request->hasFile('ssl.'.$key) && $file->isValid()) {
                $filename = str_slug($request->name . '-' . $key, '-') . '.' . $file->getClientOriginalExtension();
                $file->move(storage_path('app'), $filename);
                $certs[$key] = storage_path('app/' . $filename); // Save file name for database storage
            }
        }

        $server = Server::findOrFail($id);

        // Test connection to server before saving
        $connect = mysqli_init();

        if($request->db_ssl) { // Initialize connection for SSL using existing values or newly updated ones
            $connect->ssl_set(
                (isset($certs['db_key']) ? $certs['db_key'] : (isset($server->db_key) ? $server->db_key : null)),
                (isset($certs['db_cert']) ? $certs['db_cert'] : (isset($server->db_cert) ? $server->db_cert : null)),
                (isset($certs['db_ca']) ? $certs['db_ca'] : (isset($server->db_ca) ? $server->db_ca : null)),
                null,
                null
            );
        }

        try{
            $connect->real_connect($request->db_host, $request->db_username, $request->db_password, $request->db_database, $request->db_port, null, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
        } catch (\ErrorException $e) {
            return redirect()->route('admin.servers.edit', [$id])->withInput()->with('message', trans('app.dbNotConnect'))->with('messageDetails', mysqli_connect_error());
        }

        $prefix = $connect->real_escape_string($request->db_prefix);
        $query = $connect->query('SHOW TABLES LIKE "' . $prefix . 'players"');

        if(!$query || mysqli_num_rows($query) <= 0) {
            return redirect()->route('admin.servers.edit', [$id])->withInput()->with('message', trans('app.missingDbTables'));
        }

        $server->fill($request->except(['db_ssl', 'ssl']));
        if($request->db_ssl && count($certs)) { // New files were uploaded
            $server->db_ssl = true;
            $server->fill($certs);
        } elseif(!$request->db_ssl && $server->db_ssl) { // This setting was turned off
            $server->db_ssl = false; // Unset
            array_map('unlink', [$server->db_ca, $server->db_cert, $server->db_key]); // Unset and delete files
            $server->db_ca = $server->db_key = $server->db_cert = null; // Unset
        } // Otherwise we keep the files that were set on the server already for SSL
        $server->save();

        \Cache::flush();

		return redirect()->route('admin.servers.index')->with('message', trans('app.updatedServer'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$server = Server::findOrFail($id);
		$server->delete();

		\Cache::flush();

		return redirect()->route('admin.servers.index')->with('message', trans('app.removedServer'));
	}

}
