<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ trans('app.page.description') }}">
	<meta name="generator" content="BoNeMEAL">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>{{ trans('app.page.title') }}</title>

	<link href="{{ asset('/styles/site.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	@include('partials.navigation')

	<div class="content">
		@include('partials.flash')

		@yield('content')
	</div>

	<footer>
		<div class="container">
			<hr />
			<p>&copy; {{ date('Y') }} <a href="https://github.com/ftbastler/BoNeMEAL">{{ trans('app.copyright') }}</a> &ndash; {{ trans('app.footerNotice') }}</p>
		</div>
	</footer>

	<script src="{{ asset('/scripts/site.js') }}" type="text/javascript"></script>

	@yield('scripts')
</body>
</html>
