<?php 

use \Carbon\Carbon;

function timePasedToPercent(Carbon $future, Carbon $past) {
	return round(Carbon::now()->diffInSeconds($past) / $past->diffInSeconds($future), 2) * 100;
}
