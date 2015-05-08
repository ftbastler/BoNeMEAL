<?php 

use \Carbon\Carbon;

function timePasedToPercent(Carbon $future, Carbon $past) {
	if($past->diffInSeconds($future) == 0)
		return 1;
	return round(Carbon::now()->diffInSeconds($past) / $past->diffInSeconds($future), 2) * 100;
}
