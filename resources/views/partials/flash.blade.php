@if (session('message'))
<div class="flashmsg">
	<div class="alert alert-box alert-info">
		<strong>{{ trans('app.notice') }}</strong><br>
		{{ session('message') }}
	</div>
</div>
@endif