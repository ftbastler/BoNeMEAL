@if (session('message'))
<div class="flashmsg">
	<div class="alert alert-box alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>{{ trans('app.notice') }}</strong><br>
		{{ session('message') }}
	</div>
</div>
@endif