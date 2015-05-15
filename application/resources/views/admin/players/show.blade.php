@extends('admin.app')

@section('content')
@unless($player->name == "Console")
<div class="row">
	<div class="col-lg-10">
		<h1 class="page-header">{{ trans('app.player') }}: {{ $player->name }}</h1>
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
		<li><a href="{{ url('/admin/bans/create', $player->uuid) }}"><i class="fa fa-ban"></i> {{ trans('app.banPlayer') }}</a></li>
		<li><a href="{{ url('/admin/mutes/create', $player->uuid) }}"><i class="fa fa-microphone-slash"></i> {{ trans('app.mutePlayer') }}</a></li>
		<li><a href="{{ url('/admin/warnings/create', $player->uuid) }}"><i class="fa fa-comment"></i> {{ trans('app.warnPlayer') }}</a></li>
		<li class="divider"></li>
		<li><a href="{{ url('/admin/notes/create', $player->uuid) }}"><i class="fa fa-paperclip"></i> {{ trans('app.addNotePlayer') }}</a></li>
	</ul>
</div>

<div class="row">
	<div class="col-md-12">
		<ul class="timeline">
			@foreach($activity as $item)		
			@include('partials.timelineItem', ['item' => $item, 'admin' => true])
			@endforeach
		</ul>
	</div>
</div>
@else
<div class="container">
<br />
<center>
	<img class="media-object img-rounded" src="https://minotar.net/helm/Console/500.png" alt="Console" style="width: 300px; height: 300px;">
	<h3>{{ getRandomEasterEggMessage() }}</h3>
</center>
</div>
@endunless
@endsection
