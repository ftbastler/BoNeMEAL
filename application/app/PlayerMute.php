<?php namespace App;

use \App\RecordBaseModel;
use \Carbon\Carbon;

class PlayerMute extends RecordBaseModel {

	protected $table = 'player_mutes';

	public function scopeActive($query)
	{
		return $query->where(function ($query) {
		    $query->where('expires', '>=', Carbon::now()->timestamp)
			->orWhere('expires', '=', 0);
		});
	}

	public function scopeOutdated($query)
	{
		return $query->where('expires', '<', Carbon::now()->timestamp)->where('expires', '!=', 0);
	}

	public function getOldAttribute() {
		return false;
	}

}
