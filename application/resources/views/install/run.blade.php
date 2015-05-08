@extends('install.app')

@section('content')

<div class="container">
		<ul class="wizard">
			<li class="text-muted"><span class="badge">1 <i class="fa fa-check fa-fw"></i></span> <span class="hidden-xs">Welcome</span></li>
			<li class="text-muted"><span class="badge">2 <i class="fa fa-check fa-fw"></i></span> <span class="hidden-xs">Configuration</span></li>
			<li class="active"><span class="badge">3</span> <span class="hidden-xs">Installation</span></li>
			<li><span class="badge">4</span> <span class="hidden-xs">Finished</span></li>
		</ul>

		<div class="content">
			<h1>Installing...</h1><hr/>
			<p class="lead">Please wait while the application is being installed.</p>

			<div class="progress progress-striped active">
				<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;" id="progress-bar">
				<span class="sr-only">Installing...</span>
			  </div>
			</div>

			<pre class="console" id="output"></pre>
		</div>
</div>

@endsection