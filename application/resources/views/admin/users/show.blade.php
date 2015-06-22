@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.user') }}: {{ $user->name }}</h1>
	</div>
</div>

<dl>
	<dt>{{ trans('app.table.id') }}</dt>
	<dd>{{ $user->id }}</dd>
	<dt>{{ trans('app.table.name') }}</dt>
	<dd>{{ $user->name }}</dd>
	<dt>{{ trans('app.role.role') }}</dt>
	<dd>{{ $user->readableRole }} ({{ $user->role }})</dd>
	<dt>{{ trans('app.table.email') }}</dt>
	<dd>{{ $user->email }}</dd>
</dl>

<a href="{{ url('/admin/users', [$user->id, 'edit']) }}" class="btn btn-large btn-primary">{{ trans('app.edit') }}</a>

@endsection
