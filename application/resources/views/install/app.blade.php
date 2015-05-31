<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="robots" content="noindex, nofollow">
	<meta name="generator" content="BoNeMEAL">

	<link href="{{ asset('/styles/install.css') }}" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="{{ asset('/scripts/install.js') }}" type="text/javascript"></script>

	<title>Installer | BoNeMEAL</title>
</head>
<body>
<div class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img src="{{ asset('images/mc_bone.png') }}" style="float: left; max-height: 25px; margin-right: 10px;" /> BoNeMEAL - Installer</a>
		</div>
		<div class="collapse navbar-collapse navbar-right">
			<ul class="nav navbar-nav">
				<li><a href="https://github.com/ftbastler/BoNeMEAL" target="_blank">GitHub</a></li>
				<li><a href="http://dev.bukkit.org/bukkit-plugins/ban-management/" target="_blank">Bukkit Plugin</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="content">
@yield('content')
</div>

<div class="container">
	<div class="footer">
		<hr>
		<p>&copy; <a href="https://github.com/ftbastler/BoNeMEAL/graphs/contributors" target="_blank">BoNeMEAL</a></p>
	</div>
</div>
<br />

</body>
</html>