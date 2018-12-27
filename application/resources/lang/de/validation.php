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
	"date_format"          => ":attribute passt nicht zum vorgegebenem Format :format.",
	"different"            => ":attribute und :other müssen unterschiedlich sein.",
	"digits"               => ":attribute muss mindestens :digits Ziffern enthalten.",
	"digits_between"       => ":attribute muss mindestens :min und maximal :max Ziffern enthalten.",
	"email"                => ":attribute muss eine gültige E-Mail Adresse sein.",
	"filled"               => ":attribute wird benötigt.",
	"exists"               => ":attribute ist ungültig.",
	"image"                => ":attribute muss ein Bild sein.",
	"in"                   => ":attribute ist ungültig.",
	"integer"              => ":attribute muss eine ganze Zahl sein.",
	"ip"                   => ":attribute muss eine gültige IP-Adresse sein.",
	"max"                  => [
		"numeric" => ":attribute darf nicht größer sein als :max sein.",
		"file"    => ":attribute darf nicht größer sein als :max Kilobytes sein.",
		"string"  => ":attribute darf nicht mehr als :max Buchstaben enthalten.",
		"array"   => ":attribute darf nicht mehr als :max Items enthalten.",
	],
	"mimes"                => ":attribute muss vom Datei-Typ her eins von den folgenden sein: :values.",
	"min"                  => [
		"numeric" => ":attribute muss mindestens :min groß sein.",
		"file"    => ":attribute muss mindestens :min Kilobytes groß sein.",
		"string"  => ":attribute muss mindestens :min Buchstaben enthalten.",
		"array"   => ":attribute muss mindestens :min Items enthalten.",
	],
	"not_in"               => ":attribute ist ungültig.",
	"numeric"              => ":attribute muss eine Zahl sein.",
	"regex"                => ":attribute ist ungültig.",
	"required"             => ":attribute wird benötigt.",
	"required_if"          => ":attribute wird benötigt wenn :other den Wert :value hat.",
	"required_with"        => ":attribute wird benötigt wenn :values gegenwärtig sind.",
	"required_with_all"    => ":attribute wird benötigt wenn :values gegenwärtig sind.",
	"required_without"     => ":attribute wird benötigt wenn :values nicht gegenwärtig sind.",
	"required_without_all" => ":attribute wird benötigt wenn keine der folgenden Werte gegenwärtig sind: :values.",
	"same"                 => ":attribute und :other müssen übereinstimmen.",
	"size"                 => [
		"numeric" => ":attribute muss :size groß sein.",
		"file"    => ":attribute muss :size Kilobytes groß sein.",
		"string"  => ":attribute muss :size Buchstaben enthalten.",
		"array"   => ":attribute muss :size Items enthalten.",
	],
	"unique"               => ":attribute wird bereits verwendet.",
	"url"                  => ":attribute ist ungültig.",
	"timezone"             => ":attribute muss eine gültige Zeitzone sein.",
	"role"                 => ":attribute muss eine gültige Benutzer-Rolle sein.",
	"future"               => ":attribute muss eine gültige Zeit bzw. Datum sein.",

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
		"db_username" => "Datenbank Benutzername",
		"db_password" => "Datenbank Passwort",
		"db_database" => "Datenbank Name",
		"db_prefix" => "Datenbank Prefix",
        "db_port"   => "Datenbankport (Standard: 3306)",
        "db_ssl"    => "Datenbank erfordert SSL",
        "ssl"       => array(
            "db_ca" => "Zertifikat der Datenbank-CA",
            "db_cert"  => "Öffentliches Zertifikat der Datenbank",
            "db_key"    => "Öffentlicher Schlüssel der Datenbank",
        ),
	],

];
