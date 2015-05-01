<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class IpBan extends Model {

	protected $appends = ['actor_uuid'];

	protected $hidden = ['actor_id'];

	protected $table = 'ip_bans';

	public function getActorUuidAttribute()
	{	
		$this->attributes['actor_uuid'] = id_to_uuid($this->attributes['actor_id']);
		return $this->attributes['actor_uuid'];
	}

	public function setActorUuidAttribute($value)
	{
		$this->attributes['actor_uuid'] = $value;
		$this->attributes['actor_id'] = uuid_to_id($value);
	}

}
