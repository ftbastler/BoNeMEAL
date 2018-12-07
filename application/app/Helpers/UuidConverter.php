<?php

function id_to_uuid($id) {
	return unpack("H*", $id)[1];
}

function uuid_to_id($uuid) {
	// Strip out hyphens for better compatability with banmanager
	$uuid = str_replace("-","", $uuid);
	return pack("H*", $uuid);
}