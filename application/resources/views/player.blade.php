@extends('app')

@section('content')
@unless($player->name == "Console")
<div class="container">
	<div class="jumbotron">
		<div class="media">
			<div class="pull-left" style="margin-right: 20px;">
				<img class="media-object img-rounded" src="https://minotar.net/helm/{{ $player->name }}/150.png" alt="{{ $player->name }}" style="width: 150px; height: 150px;">
			</div>
			<div class="media-body">
				<h1 class="media-heading">{{ $player->name }}</h1>
				<hr />
				<span>
				<h3>
				@if($activeBans->count() > 0)
					<i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="{{ trans('app.currentlyBanned') }}"></i>
				@endif
				@if($activeMutes->count() > 0)
					<i class="fa fa-microphone-slash" data-toggle="tooltip" data-placement="top" title="{{ trans('app.currentlyMuted') }}"></i>
				@endif
				@if($activeBans->count() <= 0 && $activeMutes->count() <= 0)
					{{ trans('app.currentlyNotPunished') }}
				@endif
				</h3>
				</span>

				<p>
				@unless(Auth::guest())
					<a href="{{ url('/admin/players/'.$player->uuid) }}" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
				@endunless
				<a href="#" style="display: none;" id="toggleAllTimelineItems" class="btn btn-sm btn-default">{{ trans('app.toggleAllTimelineItems') }}</a>
				</p>
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
@else
<div class="container">
<center>
	<img class="media-object img-rounded" src="https://minotar.net/helm/Console/500.png" alt="Console" style="width: 300px; height: 300px;">
	<h3>{{ getRandomEasterEggMessage() }}</h3>
</center>
</div>
@endunless
@endsection
