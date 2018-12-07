@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.editNote') }} (#{{ $note->id }} on {{ $server->name }})</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::open(array('url' => '/admin/notes/' . $server->id . '/' . $note->id, 'class' => 'text-right')) !!}
{!! Form::hidden('_method', 'DELETE') !!}
{!! Form::submit(trans('app.remove'), array('class' => 'btn btn-warning confirmDelete')) !!}
{!! Form::close() !!}

<div class="row">
	<div class="col-lg-12">
		{!! Form::model($note, array('action' => array('PlayerNoteController@update', $server->id, $note->id), 'method' => 'PUT')) !!}

		<div class="form-group">
			{!! Form::label('player', trans('app.player')) !!}
			{!! Form::text('player', Input::old('player') ?: $note->player->name, array('class' => 'form-control', 'id' => 'autocomplete')) !!}
		</div>

		<div class="form-group">
			{!! Form::label('message', trans('app.message')) !!}
			{!! Form::text('message', Input::old('message'), array('class' => 'form-control', 'placeholder' => 'Might use fly hack')) !!}
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