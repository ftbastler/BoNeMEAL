<?php namespace App;

use \App\RecordBaseModel;
use \Carbon\Carbon;

class PlayerBan extends RecordBaseModel {

	protected $table = 'player_bans';

	public function scopeActive($query)
	{
		return $query->where('expires', '>=', Carbon::now())->orWhere('expires', '=', 0);
	}

}
