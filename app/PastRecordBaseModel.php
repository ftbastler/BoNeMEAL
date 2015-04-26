<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PastRecordBaseModel extends Model {

	protected $appends = ['past_actor_uuid', 'player_uuid', 'actor_uuid', 'created_at'];

	protected $hidden = ['pastActor_id', 'player_id', 'actor_id'];

	protected $dates = ['created', 'pastCreated', 'expired'];

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

	public function getPlayerUuidAttribute()
	{	
		$this->attributes['player_uuid'] = unpack("H*", $this->attributes['player_id'])[1];
		return $this->attributes['player_uuid'];
	}

	public function setPlayerUuidAttribute($value)
	{
		$this->attributes['player_uuid'] = $value;
		$this->attributes['player_id'] = pack("H*", $value);
	}

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

	public function actor()
	{
		return $this->belongsTo('App\Player', 'actor_id');
	}

	public function pastActor()
	{
		return $this->belongsTo('App\Player', 'pastActor_id');
	}

	public function player()
	{
		return $this->belongsTo('App\Player', 'player_id');
	}

	public function getCreatedAtAttribute() {
		return $this->pastCreated;
	}
}
