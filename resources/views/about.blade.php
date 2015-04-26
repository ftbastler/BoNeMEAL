@extends('app')

@section('content')
<div class="container">
	<h1>{{ trans('app.aboutUs') }}</h1>
	<p class="lead">{{ trans('app.aboutUsLead') }}</p>
	<p>{!! trans('app.aboutUsText') !!}</p>
	<br />
	<p><a href="https://github.com/ftbastler/BoNeMEAL" class="btn btn-primary">{{ trans('app.learnMore') }}</a></p>
</div>
@endsection
