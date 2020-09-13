<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

	protected $appends = ['uuid'];

	protected $hidden = ['id'];

	protected $dates = ['lastSeen'];

	protected $table = 'players';

	public $timestamps = false;

	public function bans()
	{
		return $this->hasManyRelation('App\PlayerBan');
	}

	public function mutes()
	{
		return $this->hasManyRelation('App\PlayerMute');
	}

	public function kicks()
	{
		return $this->hasManyRelation('App\PlayerKick');
	}

	public function notes()
	{
		return $this->hasManyRelation('App\PlayerNote');
	}

	public function warnings()
	{
		return $this->hasManyRelation('App\PlayerWarning');
	}

	public function pastBans()
	{
		return $this->hasManyRelation('App\PlayerBanRecord');
	}

	public function pastMutes()
	{
		return $this->hasManyRelation('App\PlayerMuteRecord');
	}

	public function getIpAttribute() {
	    // Unpack varbinary
	    $ip = unpack('C*', $this->attributes['ip']);
	    // Format IPv4 and IPv6 correctly
	    $glue = count($ip) == 4 ? "." : ":";
	    return implode($glue, $ip);
    }

	public function getUuidAttribute()
	{	
		$this->attributes['uuid'] = id_to_uuid($this->attributes['id']);
		// Fixes #109 when uuid not set
		return $this->attributes['uuid'] ?: 'unset';
	}

	public function setUuidAttribute($value)
	{
		$this->attributes['uuid'] = $value;
		$this->attributes['id'] = uuid_to_id($value);
	}

	public function setCreatedAttribute($value)
    {
        $this->attributes['lastSeen'] = $value->timestamp;
    }

	/**
	 * A little bit of hacking to make Laravel work with multiple databases
	 */
	private function hasManyRelation($value) {
		\Config::set('database.default', $this->getConnectionName());
		$relation = $this->hasMany($value);
		$relation->getRelated()->setConnection($this->getConnectionName());
		\Config::set('database.default', 'local');
		return $relation;
	}

}
