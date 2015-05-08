@extends('app')

@section('content')
<div class="container">
	<div class="jumbotron">
		<center><h1>{{ trans('app.error404Title') }}</h1></center>
		<br />
		<div class="container">
			<p>{{ trans('app.error404Text') }}</p>
		</div>
	</div>
</div>
@endsection
