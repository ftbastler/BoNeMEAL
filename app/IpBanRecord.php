<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class IpBanRecord extends Model {

	protected $appends = ['actor_uuid', 'past_actor_uuid'];

	protected $hidden = ['actor_id', 'pastActor_id'];

	protected $table = 'ip_ban_records';

	public function getActorUuidAttribute()
	{	
		$this->attributes['actor_uuid'] = unpack("H*", $this->attributes['actor_id'])[1];
		return $this->attributes['actor_uuid'];
	}

	public function setActorUuidAttribute($value)
	{
		$this->attributes['actor_uuid'] = $value;
		$this->attributes['actor_id'] = pack("H*", $value);
	}

	public function getPastActorUuidAttribute()
	{	
		$this->attributes['past_actor_uuid'] = unpack("H*", $this->attributes['pastActor_id'])[1];
		return $this->attributes['past_actor_uuid'];
	}

	public function setPastActorUuidAttribute($value)
	{
		$this->attributes['past_actor_uuid'] = $value;
		$this->attributes['pastActor_id'] = pack("H*", $value);
	}

}
