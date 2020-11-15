@extends('layouts.app')

@section('content')
    <div class="py-5 pattern-bg text-white">
        <div class="container">
            <h1>{{ __('app.frontTitle') }}</h1>
            <p class="lead">{{ __('app.frontText') }}</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="input-group {{ session('error') ? 'has-error' : '' }}">
                    <input type="text" name="playername" id="playername" data-provide="typeahead" autocomplete="off" class="form-control shadow border-0" value="{{ old('playername') }}" placeholder="{{ __('app.enterPlayerName') }}" required />
                    <span class="input-group-append">
						<button class="btn btn-light shadow" type="submit">
							<i class="fas fa-search"></i> {{ __('app.check') }}
						</button>
					</span>
                </div>

                @if(session('error'))
                    <div class="help-block">{{ session('error') }}</div>
                @endif
            </div>
        </div>
    </div>

@endsection
