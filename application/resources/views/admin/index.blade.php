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
						<div class="huge">{{ $activeBans }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.activeBan', $activeBans)) }}</div>
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
						<div class="huge">{{ $activeMutes }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.activeMute', $activeMutes)) }}</div>
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
						<div class="huge">{{ $newAccounts }}</div>
						<div>{{ ucfirst(Lang::choice('app.choice.newAccount', $newAccounts)) }}</div>
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
				{{ trans('app.onlinePlayers') }}
			</div>
			<div class="panel-body">
				<canvas id="myChart0" style="min-width: 100%" height="100"></canvas>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ trans('app.playerSplit') }}
					</div>
					<div class="panel-body">
						<canvas id="myChart1" style="min-width: 100%" height="200"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						{{ trans('app.punishmentSplit') }}
					</div>
					<div class="panel-body">
						<canvas id="myChart2" style="min-width: 100%" height="200"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-rss fa-fw"></i> {{ trans('app.activity') }}
			</div>
			<div class="panel-body">
				<div class="list-group">
					@foreach($activity as $item)
					@include('partials.activityItem', ['item' => $item])
					@endforeach
				</div>
				<a href="{{ url('/admin/activity') }}" class="btn btn-block btn-default">{{ trans('app.details') }}</a>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-refresh"></i> {{ trans('app.updateCheck') }}
			</div>
			<div class="panel-body">
				<div id="update" class="updates">{{ trans('app.loading') }}...</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		checkUpdates();

		var data0 = {
			labels: ["{!! implode('","', array_keys($lastSeenStats)) !!}"],
			datasets: [
			{
				label: "{{ trans('app.players') }}",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [
				{{ implode(',', $lastSeenStats) }}
				]
			}
			]
		};

		var data1 = [
		{
			value: {{ $activeBans }},
			color:"#d9534f",
			label: "{{ ucfirst(Lang::choice('app.choice.bannedPlayer', $activeBans)) }}"
		},
		{
			value: {{ $activeMutes }},
			color: "#f0ad4e",
			label: "{{ ucfirst(Lang::choice('app.choice.mutedPlayer', $activeMutes)) }}"
		},
		{
			value: {{ $numPlayers - $activeBans - $activeMutes }},
			color: "#2196f3",
			label: "{{ ucfirst(Lang::choice('app.choice.normalPlayer', $numPlayers - $activeBans - $activeMutes)) }}"
		}
		];

		var data2 = [
		{
			value: {{ $numBans }},
			color:"#d9534f",
			label: "{{ ucfirst(Lang::choice('app.choice.ban', $numBans)) }}"
		},
		{
			value: {{ $numMutes }},
			color: "#f0ad4e",
			label: "{{ ucfirst(Lang::choice('app.choice.mute', $numMutes)) }}"
		},
		{
			value: {{ $numKicks }},
			color: "#2196f3",
			label: "{{ ucfirst(Lang::choice('app.choice.kick', $numKicks)) }}"
		},
		{
			value: {{ $numWarnings }},
			color: "#9c27b0",
			label: "{{ ucfirst(Lang::choice('app.choice.warning', $numWarnings)) }}"
		},
		{
			value: {{ $numNotes }},
			color: "#5cb85c",
			label: "{{ ucfirst(Lang::choice('app.choice.note', $numNotes)) }}"
		}
		];

		var options = {
			segmentShowStroke : true,
			segmentStrokeColor : "#fff",
			segmentStrokeWidth : 2,
			percentageInnerCutout : 40, // This is 0 for Pie charts
			animationSteps : 100,
			animationEasing : "easeInOutQuint",
			animateRotate : true,
			animateScale : true,
			pointHitDetectionRadius : 5
		};

		var ctx0 = document.getElementById("myChart0").getContext("2d");
		new Chart(ctx0).Line(data0, options);

		var ctx1 = document.getElementById("myChart1").getContext("2d");
		new Chart(ctx1).Pie(data1, options);

		var ctx2 = document.getElementById("myChart2").getContext("2d");
		new Chart(ctx2).Pie(data2, options);
	});
</script>
@endsection