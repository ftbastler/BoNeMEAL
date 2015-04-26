@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-10">
		<h1 class="page-header">{{ trans('app.player') }}: {{ $player->name }} 
			<span style="margin-left: 5px">
				@if(count($activeBans) > 0)
				<i class="fa fa-ban text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyBanned') }}"></i>
				@endif
				@if(count($activeMutes) > 0)
				<i class="fa fa-microphone-slash text-muted" rel="tooltip" data-placement="right" title="{{ trans('app.currentlyMuted') }}"></i>
				@endif
			</span>
		</h1>
		<h4>
			<span class="label label-default">{{ count($pastBans) + count($bans) }} {{ Lang::choice('app.choice.ban', count($pastBans) + count($bans)) }}</span>
			<span class="label label-default">{{ count($pastMutes) + count($mutes) }} {{ Lang::choice('app.choice.mute', count($pastMutes) + count($mutes)) }}</span>
			<span class="label label-default">{{ count($warnings) }} {{ Lang::choice('app.choice.warning', count($warnings)) }}</span>
			<span class="label label-default">{{ count($kicks) }} {{ Lang::choice('app.choice.kick', count($kicks)) }}</span>
			<span class="label label-default">{{ count($notes) }} {{ Lang::choice('app.choice.note', count($notes)) }}</span>
		</h4>
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
	<li><a href="#"><i class="fa fa-ban"></i> {{ trans('app.banPlayer') }}</a></li>
		<li><a href="#"><i class="fa fa-microphone-slash"></i> {{ trans('app.mutePlayer') }}</a></li>
		<li><a href="#"><i class="fa fa-comment"></i> {{ trans('app.warnPlayer') }}</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-paperclip"></i> {{ trans('app.addNotePlayer') }}</a></li>
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
