@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.editWarning') }} (#{{ $warning->id }} on {{ $server->name }})</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::open(array('url' => '/admin/warnings/' . $server->id . '/' . $warning->id, 'class' => 'pull-right')) !!}
{!! Form::hidden('_method', 'DELETE') !!}
{!! Form::submit(trans('app.remove'), array('class' => 'btn btn-warning')) !!}
{!! Form::close() !!}

<div class="row">
	<div class="col-lg-12">
		{!! Form::model($warning, array('action' => array('PlayerWarningController@update', $server->id, $warning->id), 'method' => 'PUT')) !!}

		<div class="form-group">
			{!! Form::label('player', trans('app.player')) !!}
			{!! Form::text('player', Input::old('player') ?: $warning->player->name, array('class' => 'form-control', 'id' => 'autocomplete')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('reason', trans('app.reason')) !!}
			{!! Form::text('reason', Input::old('reason'), array('class' => 'form-control', 'placeholder' => 'Hacking and Cheating')) !!}
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
	});
</script>
@endsection