<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model {

	protected $connection = 'local';

	protected $table = 'servers';

	protected $hidden = ['db_host', 'db_username', 'db_password'];

}
