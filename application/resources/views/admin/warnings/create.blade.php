@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.warnPlayer') }}</h1>
	</div>
</div>

@include('partials.validationErrors')

<div class="row">
	<div class="col-lg-12">
		{!! Form::open(array('url' => array('/admin/warnings'), 'method' => 'post')) !!}

		<div class="form-group">
			{!! Form::label('server', trans('app.server')) !!}
			{!! Form::select('server', $servers, Input::old('server'), array('class' => 'form-control', 'id' => 'server')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('player', trans('app.player')) !!}
			{!! Form::text('player', isset($player) ? $player->name : Input::old('player'), array('class' => 'form-control', 'id' => 'autocomplete')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('reason', trans('app.reason')) !!}
			{!! Form::text('reason', Input::old('reason'), array('class' => 'form-control', 'placeholder' => 'Trying to hack the server.')) !!}
		</div>

		<br />
		{!! Form::submit(trans('app.save'), array('class' => 'btn btn-primary')) !!}

		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$("#server").change(function() {
		$("#autocomplete").keyup();
	});

	$("#autocomplete").autocomplete("{{ url('/') }}", function() {
		return $("#server").val();
	});
</script>
@endsection