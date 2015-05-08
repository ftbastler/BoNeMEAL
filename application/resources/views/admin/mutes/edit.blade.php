@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.editmute') }} (#{{ $mute->id }} on {{ $server->name }})</h1>
	</div>
</div>

@include('partials.validationErrors')

<div class="row">
	<div class="col-lg-12">
		{!! Form::model($mute, array('action' => array('PlayerMuteController@update', $server->id, $mute->id), 'method' => 'PUT')) !!}

		<div class="form-group">
			{!! Form::label('player', trans('app.player')) !!}
			{!! Form::text('player', Input::old('player') ?: $mute->player->name, array('class' => 'form-control', 'id' => 'autocomplete')) !!}
			<p id="results"></p>
		</div>

		<div class="form-group">
			{!! Form::label('expires', trans('app.expires')) !!}
			{!! Form::text('expires', Input::old('expires') ?: ($mute->expires->timestamp == 0 ? '' : $mute->expires->toDateTimeString()), array('class' => 'form-control', 'id' => 'datetimepicker')) !!}
			<p>{{ trans('app.leaveEmptyForPermanent') }}</p>
		</div>

		<div class="form-group">
			{!! Form::label('reason', trans('app.reason')) !!}
			{!! Form::text('reason', Input::old('reason'), array('class' => 'form-control', 'placeholder' => 'Swearing')) !!}
		</div>

		<br />
		{!! Form::submit(trans('app.save'), array('class' => 'btn btn-primary')) !!}

		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$("#autocomplete").autocomplete("{{ url('/') }}", function() {
		return "{{ $server->id }}";
	}, "#results");
</script>
@endsection