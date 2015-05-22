@extends('app')

@section('content')
<div class="container">
	<h2 class="page-header" style="margin-top: 0px;">{{ trans('app.statistics') }}</h2>
	
	<h3>{{ trans('app.generalStats') }}</h3>

	<canvas id="myChartBars" style="min-width: 100%" height="90"></canvas>

	<br />
	<h3>{{ trans('app.serverStats') }}</h3>

	<div class="row">
		@foreach($servers as $server)
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<div class="caption">
					<h3 style="margin-top: 0px">{{ $server->name }}</h3>
					<br />
					<canvas id="myChart{{ $server->id }}" style="min-width: 100%" height="150"></canvas>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		var options = {
			segmentShowStroke : true,
			segmentStrokeColor : "#fff",
			segmentStrokeWidth : 2,
			percentageInnerCutout : 40, // This is 0 for Pie charts
			animateRotate : false,
			animateScale : false,
			pointHitDetectionRadius : 5
		};

		var dataBars = {
			labels: [
					"{{ ucfirst(Lang::choice('app.choice.ban', $nums['numBans'])) }}",
					"{{ ucfirst(Lang::choice('app.choice.ipBan', $nums['numIpBans'])) }}",
					"{{ ucfirst(Lang::choice('app.choice.mute', $nums['numMutes'])) }}",
					"{{ ucfirst(Lang::choice('app.choice.kick', $nums['numKicks'])) }}",
					"{{ ucfirst(Lang::choice('app.choice.warning', $nums['numWarnings'])) }}"
				],
			datasets: [
			{
				label: "",
				fillColor: "rgba(220,220,220,0.5)",
				strokeColor: "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data: [{{ $nums['numBans'] }}, {{ $nums['numIpBans'] }}, {{ $nums['numMutes'] }}, {{ $nums['numKicks'] }}, {{ $nums['numWarnings'] }}]
			}
			]
		};

		var ctxBars = document.getElementById("myChartBars").getContext("2d");
		new Chart(ctxBars).Bar(dataBars, options);

		@foreach($servers as $server)
		var data{{ $server->id }} = [
		{
			value: {{ $activeBans[$server->id] }},
			color:"#d9534f",
			label: "{{ ucfirst(Lang::choice('app.choice.bannedPlayer', $activeBans[$server->id])) }}"
		},
		{
			value: {{ $activeMutes[$server->id] }},
			color: "#f0ad4e",
			label: "{{ ucfirst(Lang::choice('app.choice.mutedPlayer', $activeMutes[$server->id])) }}"
		},
		{
			value: {{ $players[$server->id] - $activeBans[$server->id] - $activeMutes[$server->id] }},
			color: "#2196f3",
			label: "{{ ucfirst(Lang::choice('app.choice.normalPlayer', $players[$server->id] - $activeBans[$server->id] - $activeMutes[$server->id])) }}"
		}
		];

		var ctx{{ $server->id }} = document.getElementById("myChart{{ $server->id }}").getContext("2d");
		new Chart(ctx{{ $server->id }}).Pie(data{{ $server->id }}, options);
		@endforeach
	});
</script>
@endsection
