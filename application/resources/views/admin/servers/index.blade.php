@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.servers') }}</h1>
	</div>
</div>

<a href="{{ url('/admin/servers/create') }}" class="btn btn-primary">{{ trans('app.addServer') }}</a>
<br /><br />

<div class="row">
	<div class="col-lg-12">
		@if(count($servers) > 0)
		<div class="dataTable_wrapper">
			<table class="table table-striped table-bordered table-hover" rel="dataTable">
				<thead>
					<tr>
						<th>{{ trans('app.table.name') }}</th>
						<th>{{ trans('app.table.db_host') }}</th>
						<th>{{ trans('app.table.db_database') }}</th>
						<th>{{ trans('app.table.created') }}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($servers as $item)
					<tr>
						<td><a href="{{ url('/admin/servers', [$item->id, 'edit']) }}">{{ $item->name }}</a></td>
						<td>{{ $item->db_host }}</td>
						<td>{{ $item->db_database }}</td>
						<td>{{ $item->created_at->diffForHumans() }}</td>
						<td>
							{!! Form::open(array('url' => '/admin/servers/' . $item->id, 'class' => 'pull-right')) !!}
							{!! Form::hidden('_method', 'DELETE') !!}
							{!! Form::submit(trans('app.remove'), array('class' => 'btn btn-warning confirmDelete')) !!}
							{!! Form::close() !!}
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

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('[rel=dataTable]').DataTable({
		responsive: true,
		order: [[3, "desc"]] // Most recent server first
	});
});
</script>
@endsection
