<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class IpBanRecord extends Model {

	protected $appends = ['actor_uuid', 'past_actor_uuid'];

	protected $hidden = ['actor_id', 'pastActor_id'];

	protected $table = 'ip_ban_records';

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

	public function getPastActorUuidAttribute()
	{	
		$this->attributes['past_actor_uuid'] = id_to_uuid($this->attributes['pastActor_id']);
		return $this->attributes['past_actor_uuid'];
	}

	public function setPastActorUuidAttribute($value)
	{
		$this->attributes['past_actor_uuid'] = $value;
		$this->attributes['pastActor_id'] = uuid_to_id($value);
	}

}
