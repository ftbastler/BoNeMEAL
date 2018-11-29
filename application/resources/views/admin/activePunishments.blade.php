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
						<th>{{ trans('app.table.reason') }}</th>
						<th>{{ trans('app.table.actor') }}</th>
						<th>{{ trans('app.table.expires') }}</th>
						<th>{{ trans('app.table.created') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse($activeItems as $item)
					<tr>
						<td><a href="{{ url('/admin/players', $item->player->uuid) }}">{{ $item->player->name }}</a></td>
						<td>{{ $item->server }}</td>
						<td>{{ $item->reason }}</td>
						<td>{{ $item->actor->name }}</td>
						<td>{{ $item->expires->timestamp == 0 ? trans('app.never') : $item->expires->diffForHumans() }}</td>
						<td>{{ $item->created_at->toDayDateTimeString() }}</td>
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
