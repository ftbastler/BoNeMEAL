@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.addServer') }}</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::open(array('url' => '/admin/servers')) !!}

<div class="form-group">
	{!! Form::label('name', trans('app.serverName')) !!}
	{!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Creative')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_host', trans('validation.attributes.db_host')) !!}
	{!! Form::text('db_host', Input::old('db_host'), array('class' => 'form-control', 'placeholder' => 'localhost')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_username', trans('validation.attributes.db_username')) !!}
	{!! Form::text('db_username', Input::old('db_username'), array('class' => 'form-control', 'placeholder' => 'root')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_password', trans('validation.attributes.db_password')) !!}
	{!! Form::text('db_password', Input::old('db_password'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_database', trans('validation.attributes.db_database')) !!}
	{!! Form::text('db_database', Input::old('db_database'), array('class' => 'form-control', 'placeholder' => 'banManager')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_prefix', trans('validation.attributes.db_prefix')) !!}
	{!! Form::text('db_prefix', Input::old('db_prefix'), array('class' => 'form-control', 'placeholder' => 'bm_')) !!}
</div>

{!! Form::submit(trans('app.addServer'), array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

<br />
<p>{{ trans('app.notice') }}: {{ trans('app.performanceNote') }}</p>
@endsection
