@extends('app')

@section('content')
<div class="container">
	<div class="jumbotron">
		<center><h1>{{ trans('app.causedTroubleQuestion') }}</h1></center>
		<br />
		<div class="container col-md-6 col-md-offset-3">
			{!! Form::open(array('url' => '/players/search', 'method' => 'POST', 'class' => 'form')) !!}
			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="input-group {{ session('error') ? 'has-error' : '' }}">
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
		</div>
		<br /><br />
	</div>
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
