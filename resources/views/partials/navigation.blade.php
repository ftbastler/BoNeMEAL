<!-- Navigation -->
@if (isset($admin))
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
@else
<nav class="navbar navbar-default navbar-static-top" role="navigation">
@endif
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">{{ trans('app.toggleNav') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">{{ trans('app.name') }}</a>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-top-links">
				<li><a href="{{ url('/home') }}">{{ trans('app.home') }}</a></li>
				<li><a href="{{ url('/about') }}">{{ trans('app.about') }}</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-top-links navbar-right">
			@if (Auth::guest())
				<li><a href="{{ url('/auth/login') }}">{{ trans('app.login') }}</a></li>
			@else
				<li><a href="{{ url('/admin') }}">{{ trans('app.adminPanel') }}</a></li>
			@endif
			</ul>
		</div>
	</div>
	@if (isset($admin))
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					{!! Form::open(array('url' => '/admin/player/search', 'method' => 'GET', 'class' => 'form')) !!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="input-group {{ session('search_error') ? 'has-error' : '' }}">
						<input type="text" name="playername" class="form-control" value="{{ old('playername') }}" placeholder="{{ trans('app.searchPlayer') }}" required />

						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
					{!! Form::close() !!}
				</li>
				<li>
					<a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i> {{ trans('app.dashboard') }}</a>
				</li>
				<li>
					<a href="{{ url('/admin/players') }}"><i class="fa fa-users fa-fw"></i> {{ trans('app.players') }}</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-gavel fa-fw"></i> {{ trans('app.activePunishments') }}<span class="fa fa-fw arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{ url('/admin/active-bans') }}">{{ trans('app.activeBans') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/active-mutes') }}">{{ trans('app.activeMutes') }}</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-edit fa-fw"></i> {{ trans('app.configuration') }}<span class="fa fa-fw arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{ url('/admin/config/app') }}">{{ trans('app.app') }}</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	@endif
</nav>