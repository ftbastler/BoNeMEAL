@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ trans('app.players') }}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		@if(count($players) > 0)
		<div class="dataTable_wrapper">
			<table class="table table-striped table-bordered table-hover" rel="dataTable">
				<thead>
					<tr>
						<th>{{ trans('app.table.player') }}</th>
						<th>{{ trans('app.table.uuid') }}</th>
						<th>{{ trans('app.table.ip') }}</th>
						<th>{{ trans('app.table.lastSeen') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($players as $item)
					<tr>
						<td><a href="{{ url('/admin/players', $item->uuid) }}">{{ $item->name }}</a></td>
						<td>{{ $item->uuid }}</td>
						<td>{{ $item->ip }}</td>
						<td>{{ $item->lastSeen->diffForHumans() }}</td>
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
		order: [[3, "desc"]] // Last seen players first
	});
});
</script>
@endsection
