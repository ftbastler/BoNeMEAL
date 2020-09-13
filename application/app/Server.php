<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model {

	protected $connection = 'local';

	protected $table = 'servers';

    protected $visible = ['name', 'db_database', 'db_prefix', 'created_at', 'updated_at'];

    protected $guarded = [];
}
