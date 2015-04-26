<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordBaseModel extends Model {

	protected $appends = ['player_uuid', 'actor_uuid', 'created_at'];

	protected $hidden = ['player_id', 'actor_id'];

	protected $dates = ['created', 'updated', 'expires'];

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

	public function player()
	{
		return $this->belongsTo('App\Player', 'player_id');
	}

	public function getCreatedAtAttribute() {
		return $this->created;
	}
}
