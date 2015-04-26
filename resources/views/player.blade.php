@extends('app')

@section('content')
<div class="container">
	<div class="jumbotron">
		<div class="media">
			<div class="pull-left" style="margin-right: 20px;">
				<img class="media-object img-rounded" src="https://minotar.net/helm/{{ $player->name }}/150.png" alt="{{ $player->name }}" style="width: 150px; height: 150px;">
			</div>
			<div class="media-body">
				<h1 class="media-heading">{{ $player->name }}
				<span style="margin-left: 5px">
				@if(count($activeBans) > 0)
					<i class="fa fa-ban text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyBanned') }}"></i>
				@endif
				@if(count($activeMutes) > 0)
					<i class="fa fa-microphone-slash text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyMuted') }}"></i>
				@endif
				</span>
				</h1>
				<hr />
				<h4>
					<span class="label label-default">{{ count($pastBans) + count($bans) }} {{ Lang::choice('app.choice.ban', count($pastBans) + count($bans)) }}</span>
					<span class="label label-default">{{ count($pastMutes) + count($mutes) }} {{ Lang::choice('app.choice.mute', count($pastMutes) + count($mutes)) }}</span>
					<span class="label label-default">{{ count($warnings) }} {{ Lang::choice('app.choice.warning', count($warnings)) }}</span>
					<span class="label label-default">{{ count($kicks) }} {{ Lang::choice('app.choice.kick', count($kicks)) }}</span>
				</h4>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
			@foreach($activity as $item)		
				@include('partials.timelineItem', ['item' => $item])
			@endforeach
			</ul>
		</div>
	</div>
</div>
@endsection
