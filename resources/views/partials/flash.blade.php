@if (count(session('msgs')) > 0)
<div class="container">
	<div class="alert alert-box alert-info">
		<strong>{{ trans('app.notice') }}</strong><br>
		<ul>
			@foreach (session('msgs') as $msg)
			<li>{{ $msg }}</li>
			@endforeach
		</ul>
	</div>
</div>
@endif