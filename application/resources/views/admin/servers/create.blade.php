@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.addServer') }}</h1>
	</div>
</div>

@include('partials.validationErrors')

{!! Form::open(array('action' => 'ServerController@store', 'method' => 'post', 'files' => true, 'autocomplete' => 'off')) !!}

<div class="form-group">
	{!! Form::label('name', trans('app.serverName')) !!}
	{!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Creative', 'required' => true)) !!}
</div>

<div class="form-group">
	{!! Form::label('db_host', trans('validation.attributes.db_host')) !!}
	{!! Form::text('db_host', Input::old('db_host'), array('class' => 'form-control', 'placeholder' => 'localhost', 'required' => true)) !!}
</div>

<div class="form-group">
	{!! Form::label('db_port', trans('validation.attributes.db_port')) !!}
	{!! Form::input('number', 'db_port', Input::old('db_port') ? Input::old('db_port') : '3306', array('class' => 'form-control', 'required' => true)) !!}
</div>

<div class="form-group">
	{!! Form::label('db_username', trans('validation.attributes.db_username')) !!}
	{!! Form::text('db_username', Input::old('db_username'), array('class' => 'form-control', 'placeholder' => 'root', 'required' => true, 'autocomplete' => 'off')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_password', trans('validation.attributes.db_password')) !!}
	{!! Form::password('db_password', array('class' => 'form-control', 'required' => true, 'autocomplete' => 'off')) !!}
</div>

<div class="form-group">
	{!! Form::label('db_database', trans('validation.attributes.db_database')) !!}
	{!! Form::text('db_database', Input::old('db_database'), array('class' => 'form-control', 'placeholder' => 'banManager', 'required' => true)) !!}
</div>

<div class="form-group">
	{!! Form::label('db_prefix', trans('validation.attributes.db_prefix')) !!}
	{!! Form::text('db_prefix', Input::old('db_prefix') ? Input::old('db_prefix') : 'bm_', array('class' => 'form-control')) !!}
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a href="#use_ssl" data-toggle="collapse">{{trans('app.serverSSL')}}</a>
		</h4>
	</div>
	<div class="panel-collapse {{Input::old('db_ssl') ? "" : "collapse"}}" id="use_ssl">
		<div class="panel-body">
			<div class="form-group">
				<label>
					{!! Form::checkbox('db_ssl', Input::old('db_ssl'), false, ['id' => 'db_ssl'] ) !!} {{trans('validation.attributes.db_ssl')}}
				</label>
				<span class="help-block">{{trans('app.helpSSL')}}</span>
			</div>

			<div class="form-group">
				{!! Form::label('ssl[db_ca]', trans('validation.attributes.ssl.db_ca')) !!}
				{!! Form::file('ssl[db_ca]') !!}
				<span class="help-block">{{trans('app.helpCA')}}</span>
			</div>

			<div class="form-group">
				{!! Form::label('ssl[db_key]', trans('validation.attributes.ssl.db_key')) !!}
				{!! Form::file('ssl[db_key]') !!}
				<span class="help-block">{{trans('app.helpKey')}}</span>
			</div>

			<div class="form-group">
				{!! Form::label('ssl[db_cert]', trans('validation.attributes.ssl.db_cert')) !!}
				{!! Form::file('ssl[db_cert]') !!}
				<span class="help-block">{{trans('app.helpCert')}}</span>
			</div>
		</div>
	</div>
</div>


{!! Form::submit(trans('app.addServer'), array('class' => 'btn btn-primary')) !!}

{!! Form::close() !!}

<br />
<p>{{ trans('app.notice') }}: {{ trans('app.performanceNote') }}</p>
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).on('change', '#db_ssl', function() {
		   if(this.checked) {
		       // Make cert fields required
			   $("#ssl\\[db_cert\\]").attr('required', true);
               $("#ssl\\[db_key\\]").attr('required', true);
		   } else {
               $("#ssl\\[db_cert\\]").removeAttr('required');
               $("#ssl\\[db_key\\]").removeAttr('required');
		   }
		});
	</script>
@endsection
