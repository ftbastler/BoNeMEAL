<?php

function id_to_uuid($id) {
	return unpack("H*", $id)[1];
}

function uuid_to_id($uuid) {
	return pack("H*", $uuid);
}