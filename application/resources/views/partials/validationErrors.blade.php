@if (isset($errors) && count($errors) > 0)
<div class="alert alert-danger">
	<strong>{{ trans('app.whoops') }}</strong> {{ trans('app.inputErrors') }}<br><br>
	{!! HTML::ul($errors->all()) !!}
</div>
@endif