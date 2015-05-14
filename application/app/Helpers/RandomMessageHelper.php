<?php

function getRandomEasterEggMessage() {
	$items = array("Here I am.", "I'm watching you.", "*beep*", "Start. Stop. Restart.", "/ban Everyone");
	return $items[array_rand($items)];
}