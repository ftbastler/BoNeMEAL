@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.editUser') }} (#{{ $user->id }})</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::model($user, array('action' => array('UserController@update', $user->id), 'method' => 'PUT')) !!}

<div class="form-group">
	{!! Form::label('name', trans('app.username')) !!}
	{!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
	{!! Form::label('role', trans('app.role.role')) !!}
	{!! Form::select('role', array(0 => trans('app.role.normalUser'), 3 => trans('app.role.moderator'), 6 => trans('app.role.admin'), 8 => trans('app.role.superuser')), Input::old('role'), array('class' => 'form-control'.($user->role > 8 ? 'disabled' : ''))) !!}
</div>

<br />
<hr style="border-color: red" />
<h5 class="text-danger">{{ trans('app.dangerZone') }}</h5>
<p>{{ trans('app.dangerZoneDesc') }}</p>

<div class="form-group">
	{!! Form::label('email', trans('app.email')) !!}
	{!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
</div>

<div class="form-group">
	{!! Form::label('password', trans('app.newPassword')) !!}
	{!! Form::password('password', array('class' => 'form-control')) !!}
</div>

<div class="form-group">
	{!! Form::label('password_confirmation', trans('app.confirmPassword')) !!}
	{!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
</div>


<hr style="border-color: red" />
<br />

{!! Form::submit(trans('app.save'), array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
@endsection
