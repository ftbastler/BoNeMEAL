<?php

function get_all_installed_langs() {
	$langs = [];

	$path = base_path() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang';
	foreach (new \DirectoryIterator($path) as $file) {
		if ($file->isDot()) continue;

		if ($file->isDir()) {
			array_push($langs, $file->getFilename());
		}
	}
	return $langs;
}