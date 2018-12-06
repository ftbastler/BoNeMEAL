@extends('admin.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ $title }}</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="dataTable_wrapper">
			<table class="table table-striped table-bordered table-hover" rel="dataTable">
				<thead>
					<tr>
						<th>{{ trans('app.table.player') }}</th>
						<th>{{ trans('app.table.server') }}</th>
						<th>{{ trans('app.table.note') }}</th>
						<th>{{ trans('app.table.actor') }}</th>
						<th>{{ trans('app.table.created') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($allNotes as $note)
					<tr>
						<td><a href="{{ url('/admin/players', $note->player->uuid) }}">{{ $note->player->name }}</a></td>
						<td>{{ $note->server }}</td>
						<td>{{ $note->message }}</td>
						<td>{{ $note->actor->name }}</td>
						<td>{{ $note->created_at->toDayDateTimeString() }}</td>
					</tr>
					@empty
						<tr class='info'><td colspan=6>{{ trans('app.noData') }}</td></tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
	$('[rel=dataTable]').DataTable({
		responsive: true,
		order: [[4, "desc"]] // Most recent notes first
	});
});
</script>
@endsection
