@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.activity') }}</h1>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('app.recentKicks') }}
	</div>
	<div class="panel-body">
		@include('partials.recentPunishmentsTable', ['items' => $recentKicks])
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('app.recentWarnings') }}
	</div>
	<div class="panel-body">
		@include('partials.recentPunishmentsTable', ['items' => $recentWarnings])
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('app.recentNotes') }}
	</div>
	<div class="panel-body">
		@include('partials.recentPunishmentsTable', ['items' => $recentNotes])
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('app.recentPastBans') }}
	</div>
	<div class="panel-body">
		@include('partials.recentPunishmentsTable', ['items' => $recentBanRecords])
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		{{ trans('app.recentPastMutes') }}
	</div>
	<div class="panel-body">
		@include('partials.recentPunishmentsTable', ['items' => $recentMuteRecords])
	</div>
</div>
@endsection