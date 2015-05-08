@extends('install.app')

@section('content')
    <div class="container">
		<ul class="wizard">
			<li class="text-muted"><span class="badge">1 <i class="fa fa-check fa-fw"></i></span> <span class="hidden-xs">Welcome</span></li>
			<li class="text-muted"><span class="badge">2 <i class="fa fa-check fa-fw"></i></span> <span class="hidden-xs">Configuration</span></li>
			<li class="text-muted"><span class="badge">3 <i class="fa fa-check fa-fw"></i></span> <span class="hidden-xs">Installation</span></li>
			<li class="active"><span class="badge">4</span> <span class="hidden-xs">Finished</span></li>
		</ul>

		<div class="content">
			<h1>Finished</h1><hr/>
			<p class="lead">Congratulations! <b>BoNeMEAL</b> has been installed successfully.</p>
			
			<div class="alert alert-box alert-danger">Note: Please make sure your <kbd>/application</kbd> folder and its contents are not publicly accessible to avoid any security threats.</p>

			<p>Thanks for using <b>BoNeMEAL</b> to manage your bans. We hope you will have a great experience with this web app. Remember to stay awesome and report all bugs using our <a href="https://github.com/ftbastler/BoNeMEAL/issues">issue tracker</a> and check for updates regularly.<br />
			Now, let's get this party started!</p>
		</div>

		<div class="buttons">
			<a href="{{ url('/') }}" class="btn btn-success"><i class="fa fa-check"></i> Finish</a>
		</div>
    </div>
@endsection