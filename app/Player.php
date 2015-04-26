<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Player extends Model {

	protected $appends = ['uuid'];

	protected $hidden = ['id'];

	protected $dates = ['lastSeen'];

	protected $table = 'players';

	public function bans()
	{
		return $this->hasMany('App\PlayerBan');
	}

	public function mutes()
	{
		return $this->hasMany('App\PlayerMute');
	}

	public function kicks()
	{
		return $this->hasMany('App\PlayerKick');
	}

	public function notes()
	{
		return $this->hasMany('App\PlayerNote');
	}

	public function warnings()
	{
		return $this->hasMany('App\PlayerWarning');
	}

	public function pastBans()
	{
		return $this->hasMany('App\PlayerBanRecord');
	}

	public function pastMutes()
	{
		return $this->hasMany('App\PlayerMuteRecord');
	}

	public function getUuidAttribute()
	{	
		$this->attributes['uuid'] = unpack("H*", $this->attributes['id'])[1];
		return $this->attributes['uuid'];
	}

	public function setUuidAttribute($value)
	{
		$this->attributes['uuid'] = $value;
		$this->attributes['id'] = pack("H*", $value);
	}

}
