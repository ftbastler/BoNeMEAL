<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PastRecordBaseModel extends Model {

	protected $appends = ['past_actor_uuid', 'player_uuid', 'actor_uuid', 'created_at'];

	protected $hidden = ['pastActor_id', 'player_id', 'actor_id'];

	protected $dates = ['created', 'pastCreated', 'expired'];

	public $timestamps = false;

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

	public function getPlayerUuidAttribute()
	{	
		$this->attributes['player_uuid'] = id_to_uuid($this->attributes['player_id']);
		return $this->attributes['player_uuid'];
	}

	public function setPlayerUuidAttribute($value)
	{
		$this->attributes['player_uuid'] = $value;
		$this->attributes['player_id'] = uuid_to_id($value);
	}

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

	public function actor()
	{
		return $this->belongsToRelation('App\Player', 'actor_id');
	}

	public function pastActor()
	{
		return $this->belongsToRelation('App\Player', 'pastActor_id');
	}

	public function player()
	{
		return $this->belongsToRelation('App\Player', 'player_id');
	}

	public function getCreatedAtAttribute() {
		return $this->pastCreated;
	}

	public function getOldAttribute() {
		return $this->created_at->diffInDays() >= 30;
	}

	public function getServerAttribute() {
		return \App\Server::find($this->getConnectionName())->name;
	}

	public function getServerIdAttribute() {
		return \App\Server::find($this->getConnectionName())->id;
	}

	public function setCreatedAttribute($value)
	{
		$this->attributes['created'] = $value->timestamp;
	}

	public function setPastCreatedAttribute($value)
	{
		$this->attributes['pastCreated'] = $value->timestamp;
	}

	public function setExpiredAttribute($value)
	{
		$this->attributes['expired'] = $value->timestamp;
	}

	/**
	 * A little bit of hacking to make Laravel work with multiple databases
	 */
	private function belongsToRelation($value1, $value2) {
		\Config::set('database.default', $this->getConnectionName());
		$relation = $this->belongsTo($value1, $value2);
		$relation->getRelated()->setConnection($this->getConnectionName());
		\Config::set('database.default', 'local');
		return $relation;
	}

}
