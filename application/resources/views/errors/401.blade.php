@extends('app')

@section('content')
<div class="container">
	<div class="jumbotron">
		<h1>{{ trans('app.error401Title') }}</h1>
		<p>{{ trans('app.error401Text') }}</p>
		<p><a href="{{ url('/') }}" class="btn btn-primary btn-lg">{{ trans('app.goToHome') }}</a></p>
	</div>
</div>
@endsection
