<?php namespace App;

use \App\RecordBaseModel;
use \Carbon\Carbon;

class PlayerMute extends RecordBaseModel {

	protected $table = 'player_mutes';

	public function scopeActive($query)
	{
		return $query->where('expires', '>', Carbon::now())->orWhere('expires', '=', 0);
	}

}
