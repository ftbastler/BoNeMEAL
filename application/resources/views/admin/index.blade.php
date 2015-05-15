@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.dashboard') }}</h1>
		
		@include('partials.noscript')
	</div>
</div>

<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-ban fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ count($activeBans) }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.activeBan', count($activeBans))) }}</div>
					</div>
				</div>
			</div>
			<a href="{{ url('/admin/active-bans') }}">
				<div class="panel-footer">
					<span class="pull-left">{{ trans('app.viewDetails') }}</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-microphone-slash fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ count($activeMutes) }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.activeMute', count($activeMutes))) }}</div>
					</div>
				</div>
			</div>
			<a href="{{ url('/admin/active-mutes') }}">
				<div class="panel-footer">
					<span class="pull-left">{{ trans('app.viewDetails') }}</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user-plus fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ count($newAccounts) }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.newAccount', count($newAccounts))) }}</div>
					</div>
				</div>
			</div>
			<a href="{{ url('/admin/users') }}">
				<div class="panel-footer">
					<span class="pull-left">{{ trans('app.viewDetails') }}</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-server fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{ count($servers) }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.totalServer', count($servers))) }}</div>
					</div>
				</div>
			</div>
			<a href="{{ url('/admin/servers') }}">
				<div class="panel-footer">
					<span class="pull-left">{{ trans('app.viewDetails') }}</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">
		@if(count($outdatedServers) > 0)
			<div class="alert alert-danger alert-box">
				<h4>{{ trans('app.warning') }}</h4>
				<p>{{ trans('app.followingServersOutdated') }}</p>
				<ul>
				@foreach($outdatedServers as $server)
					<li>{{ $server }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentKicks') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentKicks])
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentWarnings') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentWarnings])
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentNotes') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentNotes])
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentPastBans') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentBanRecords])
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentPastMutes') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentMuteRecords])
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-refresh"></i> {{ trans('app.updateCheck') }}
			</div>
			<div class="panel-body">
				<div id="update" class="updates">{{ trans('app.loading') }}...</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bell fa-fw"></i> {{ trans('app.notifications') }}
			</div>
			<div class="panel-body">
				<div class="list-group">
					@foreach($activity as $item)
						@include('partials.activityItem', ['item' => $item])
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
checkUpdates();
</script>
@endsection