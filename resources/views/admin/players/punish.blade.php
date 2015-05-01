@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.ban') }}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		{!! Form::model($player, array('url' => '/admin/player/', $player->name, '/ban')) !!}
	</div>
</div>
@endsection