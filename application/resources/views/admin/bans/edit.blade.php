@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.editBan') }} (#{{ $ban->id }} on {{ $server->name }})</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::open(array('url' => '/admin/bans/' . $server->id . '/' . $ban->id, 'class' => 'pull-right')) !!}
{!! Form::hidden('_method', 'DELETE') !!}
{!! Form::submit(trans('app.remove'), array('class' => 'btn btn-warning confirmDelete')) !!}
{!! Form::close() !!}

<div class="row">
	<div class="col-lg-12">
		{!! Form::model($ban, array('action' => array('PlayerBanController@update', $server->id, $ban->id), 'method' => 'PUT')) !!}

		<div class="form-group">
			{!! Form::label('player', trans('app.player')) !!}
			{!! Form::text('player', Input::old('player') ?: $ban->player->name, array('class' => 'form-control', 'id' => 'autocomplete')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('expires', trans('app.expires')) !!}
			{!! Form::text('expires', Input::old('expires') ?: ($ban->expires->timestamp == 0 ? '' : $ban->expires->toDateTimeString()), array('class' => 'form-control', 'id' => 'datetimepicker')) !!}
			<p>{{ trans('app.leaveEmptyForPermanent') }}</p>
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