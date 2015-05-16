@extends('app')

@section('styles')
<style>
	.navbar {
		margin-bottom: 0px;
	}
</style>
@endsection

@section('content')
<div class="pattern-bg">
	<div class="container">
		<h1>{{ trans('app.frontTitle') }}</h1>
		<p class="lead">{{ trans('app.frontText') }}</p>
	</div>
</div>

<div class="container space space-inside well">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
		<center>
		{!! Form::open(array('url' => '/players/search', 'method' => 'POST', 'class' => 'form')) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="input-group form-group-lg {{ session('error') ? 'has-error' : '' }}">
				<input type="text" name="playername" id="playername" data-provide="typeahead" autocomplete="off" class="form-control" value="{{ old('playername') }}" placeholder="{{ trans('app.enterPlayerName') }}" required />
				<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<i class="fa fa-search"></i> {{ trans('app.check') }}
						</button>
					</span>
			</div>

			@if(session('error'))
			<div class="help-block">{{ session('error') }}</div>
			<br />
			@endif
		{!! Form::close() !!}
		</center>
		</div>
	</div>
</div>

<div class="container">
	@include('partials.noscript')
</div>
@endsection

@section('scripts')
<script>
	$("#playername").autocomplete("{{ url('/') }}");

	$("#playername").data('typeahead').afterSelect = function() {
		$("#playername").closest("form").submit();
	}
</script>
@endsection
