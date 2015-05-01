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
						<div>{{ ucfirst(Lang::choice('app.choice.userAccountsForApproval', count($newAccounts))) }}</div>
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
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentBans') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentBans])
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.recentMutes') }}
			</div>
			<div class="panel-body">
				@include('partials.recentPunishmentsTable', ['items' => $recentMutes])
			</div>
		</div>
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
					<a href="#" class="list-group-item">
						<i class="fa fa-comment fa-fw"></i> New Comment
						<span class="pull-right text-muted small"><em>4 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-twitter fa-fw"></i> 3 New Followers
						<span class="pull-right text-muted small"><em>12 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-envelope fa-fw"></i> Message Sent
						<span class="pull-right text-muted small"><em>27 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-tasks fa-fw"></i> New Task
						<span class="pull-right text-muted small"><em>43 minutes ago</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-upload fa-fw"></i> Server Rebooted
						<span class="pull-right text-muted small"><em>11:32 AM</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-bolt fa-fw"></i> Server Crashed!
						<span class="pull-right text-muted small"><em>11:13 AM</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-warning fa-fw"></i> Server Not Responding
						<span class="pull-right text-muted small"><em>10:57 AM</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
						<span class="pull-right text-muted small"><em>9:49 AM</em>
						</span>
					</a>
					<a href="#" class="list-group-item">
						<i class="fa fa-money fa-fw"></i> Payment Received
						<span class="pull-right text-muted small"><em>Yesterday</em>
						</span>
					</a>
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