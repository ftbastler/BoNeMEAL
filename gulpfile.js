var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.sass('app.scss', 'resources/assets/css/');
	mix.sass('site.scss', 'resources/assets/css/');
	mix.sass('admin.scss', 'resources/assets/css/');
	mix.sass('install.scss', 'resources/assets/css/');

	mix.styles([

		'bootstrap-theme.css',
		'font-awesome.css',
		'timeline.css',
		'app.css',
		'site.css'

		], 'public/styles/site.css', 'resources/assets/css');

	mix.scripts([

		'jquery.js',
		'bootstrap.js',
		'app.js',
		'site.js',

		], 'public/scripts/site.js', 'resources/assets/js');


	mix.styles([

		'bootstrap-theme.css',
		'font-awesome.css',
		'timeline.css',
		'metismenu.css',
		'dataTables.bootstrap.css',
		'dataTables.responsive.css',
		'bootstrap-datetimepicker.css',
		'sb-admin.css',
		'app.css',
		'admin.css',

		], 'public/styles/admin.css', 'resources/assets/css');

	mix.scripts([

		'jquery.js',
		'bootstrap.js',
		'metismenu.js',
		'jquery.dataTables.js',
		'dataTables.bootstrap.js',
		'moment.js',
		'bootstrap-datetimepicker.js',
		'sb-admin.js',
		'app.js',
		'admin.js',

		], 'public/scripts/admin.js', 'resources/assets/js');

	mix.styles([

		'bootstrap-theme.css',
		'font-awesome.css',
		'timeline.css',
		'install.css',

		], 'public/styles/install.css', 'resources/assets/css');

	mix.scripts([

		'jquery.js',
		'bootstrap.js',
		'install.js',

		], 'public/scripts/install.js', 'resources/assets/js');


	//mix.phpUnit();

});
