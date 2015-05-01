@if(count($items) > 0)
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>{{ trans('app.table.player') }}</th>
				<th>{{ trans('app.table.actor') }}</th>
				<th>{{ trans('app.table.created') }}</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->player->name }}</td>
					<td>{{ $item->actor->name }}</td>
					<td>{{ $item->created->diffForHumans() }}</td>
					<td><a href="{{ url('/admin/players', $item->player->uuid) }}">{{ trans('app.details') }}</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@else
<div class="alert alert-info">{{ trans('app.noData') }}</div>
@endif