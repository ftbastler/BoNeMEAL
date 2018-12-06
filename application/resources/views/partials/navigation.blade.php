<!-- Navigation -->
@if (isset($admin))
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
@else
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
@endif
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">{{ trans('app.toggleNav') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/mc_bone.png') }}" style="width: 25px; margin-right: 5px; display: inline;" /> {{ trans('app.bonemeal') }}</a>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ url('/home') }}">{{ trans('app.home') }}</a></li>
				<li><a href="{{ url('/statistics') }}">{{ trans('app.statistics') }}</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			@if (Auth::guest())
				<li><a href="{{ url('/auth/login') }}">{{ trans('app.login') }}</a></li>
			@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/admin') }}"><i class="fa fa-cog"></i> {{ trans('app.adminPanel') }}</a></li>
						<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out"></i> {{ trans('app.logout') }}</a></li>
					</ul>
				</li>
			@endif
			</ul>
		</div>
	</div>
	@if (isset($admin) && $admin)
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					{!! Form::open(array('url' => '/admin/players/search', 'method' => 'GET', 'class' => 'form')) !!}
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
					<a href="{{ url('/admin/notes') }}"><i class="fa fa-edit fa-fw"></i> {{ trans('app.allNotes') }}</a>
				</li>
				<li>
					<a href="{{ url('/admin/users') }}"><i class="fa fa-user fa-fw"></i> {{ trans('app.users') }}</a>
				</li>
				<li>
					<a href="#"><i class="fa fa-list-alt fa-fw"></i> {{ trans('app.activePunishments') }} <span class="fa fa-fw arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{ url('/admin/active-bans') }}">{{ trans('app.activeBans') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/active-warnings') }}">{{ trans('app.activeWarnings') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/active-mutes') }}">{{ trans('app.activeMutes') }}</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-gavel fa-fw"></i> {{ trans('app.punishPlayer') }} <span class="fa fa-fw arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{ url('/admin/bans/create') }}">{{ trans('app.banPlayer') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/mutes/create') }}">{{ trans('app.mutePlayer') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/warnings/create') }}">{{ trans('app.warnPlayer') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/notes/create') }}">{{ trans('app.addNotePlayer') }}</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-edit fa-fw"></i> {{ trans('app.configuration') }} <span class="fa fa-fw arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="{{ url('/admin/servers') }}">{{ trans('app.servers') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/flush-cache') }}">{{ trans('app.flushCache') }}</a>
						</li>
						<li>
							<a href="{{ url('/admin/config') }}">{{ trans('app.settings') }}</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	@endif
</nav>