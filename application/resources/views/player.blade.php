@extends('app')

@section('content')
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
				@if($activeBans->count() > 0)
					<h3><i class="fa fa-ban text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyBanned') }}"></i></h3>
				@endif
				@if($activeMutes->count() > 0)
					<h3><i class="fa fa-microphone-slash text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyMuted') }}"></i></h3>
				@endif
				@if($activeBans->count() <= 0 && $activeMutes->count() <= 0)
					<h4>{{ trans('app.currentlyNotPunished') }}</h4>
				@endif
				</span>
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
