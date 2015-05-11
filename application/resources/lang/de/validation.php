<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute muss akzeptiert werden.",
	"active_url"           => "Die URL :attribute ist nicht gültig.",
	"after"                => ":attribute muss ein Datum nach :date sein.",
	"alpha"                => ":attribute darf nur Buchstaben enthalten.",
	"alpha_dash"           => ":attribute darf nur Buchstaben, Zahlen und Striche enthalten.",
	"alpha_num"            => ":attribute darf nur Buchstaben und Zahlen enthalten.",
	"array"                => ":attribute muss ein Array sein.",
	"before"               => ":attribute muss ein Datum vor :date sein.",
	"between"              => [
		"numeric" => "Die Zahl :attribute muss sich zwischen :min und :max befinden.",
		"file"    => "Die Datei :attribute muss sich zwischen :min und :max Kilobytes befinden.",
		"string"  => "Der String :attribute muss sich zwischen :min und :max Zeichen befinden.",
		"array"   => "Der Array :attribute muss sich zwischen :min und :max Items befinden.",
	],
	"boolean"              => ":attribute muss wahr oder falsch sein.",
	"confirmed"            => "Die Bestätigung von :attribute stimmt nicht.",
	"date"                 => ":attribute ist kein gültiges Datum.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "The :attribute must be a valid email address.",
	"filled"               => "The :attribute field is required.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	],
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "The :attribute field is required.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"unique"               => "The :attribute has already been taken.",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",
	"role"                 => "The :attribute has to be a valid user role.",
	"future"               => "The :attribute has to be a valid expire datetime.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'Previous' => [
			'Previous' => 'Vorherige',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		"name" 		=> "Name",
		"email" 	=> "E-Mail Addresse",
		"password"	=> "Passwort",
		"db_host" => "Datenbank Hoster",
		"db_username" => "Datenbank Benutzernae",
		"db_password" => "Datenbank Passwort",
		"db_database" => "Datenbank Name",
		"db_prefix" => "Datenbank Prefix",
	],

];
