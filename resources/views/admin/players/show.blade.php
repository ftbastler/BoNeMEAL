@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-10">
		<h1 class="page-header">{{ trans('app.player') }}: {{ $player->name }}</h1>
		<span>
			@if($activeBans->count() > 0)
			<h1><i class="fa fa-ban text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyBanned') }}"></i></h1>
			@endif
			@if($activeMutes->count() > 0)
			<h1><i class="fa fa-microphone-slash text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyMuted') }}"></i></h1>
			@endif
			@if($activeBans->count() <= 0 && $activeMutes->count() <= 0)
			<h4>{{ trans('app.currentlyNotPunished') }}</h4>
			@endif
		</span>
	</div>
	<div class="col-lg-2">
		<img class="media-object img-rounded" style="margin-top: 40px;" src="https://minotar.net/helm/{{ $player->name }}/150.png" alt="{{ $player->name }}" style="width: 150px; height: 150px;">
	</div>
</div>

<div class="btn-group">
	<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		{{ trans('app.punish') }} <span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li><a href="{{ url('/admin/player', [$player->name, 'ban']) }}"><i class="fa fa-ban"></i> {{ trans('app.banPlayer') }}</a></li>
		<li><a href="{{ url('/admin/player', [$player->name, 'mute']) }}"><i class="fa fa-microphone-slash"></i> {{ trans('app.mutePlayer') }}</a></li>
		<li><a href="{{ url('/admin/player', [$player->name, 'warn']) }}"><i class="fa fa-comment"></i> {{ trans('app.warnPlayer') }}</a></li>
		<li class="divider"></li>
		<li><a href="{{ url('/admin/player', [$player->name, 'note']) }}"><i class="fa fa-paperclip"></i> {{ trans('app.addNotePlayer') }}</a></li>
	</ul>
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
@endsection
