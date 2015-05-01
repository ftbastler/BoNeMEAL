@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.users') }}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		@if(count($users) > 0)
		<div class="dataTable_wrapper">
			<table class="table table-striped table-bordered table-hover" rel="dataTable">
				<thead>
					<tr>
						<th>{{ trans('app.table.email') }}</th>
						<th>{{ trans('app.table.name') }}</th>
						<th>{{ trans('app.table.role') }}</th>
						<th>{{ trans('app.table.created') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $item)
					<tr>
						<td>
						@if($item->role != 8)
							<a href="{{ url('/admin/users', [$item->id, 'edit']) }}">{{ $item->email }}</a>
						@else
							{{ $item->email }}
						@endif
						</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->readableRole }} ({{ $item->role }})</td>
						<td>{{ $item->created_at->diffForHumans() }}</td>
						<td>
						@if($item->role != 8)
							{!! Form::open(array('url' => '/admin/users/' . $item->id, 'class' => 'pull-right')) !!}
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit(trans('app.remove'), array('class' => 'btn btn-warning')) !!}
							{!! Form::close() !!}
						@endif
						</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@else
			<div class="alert alert-info">{{ trans('app.noData') }}</div>
			@endif
		</div>
	</div>
@endsection
