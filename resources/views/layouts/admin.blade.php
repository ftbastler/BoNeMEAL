<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ trans('app.page.description') }}">
    <meta name="generator" content="BoNeMEAL">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="noindex, follow">

    <title>{{ __('app.page.title') }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body id="page-top">
    <div id="wrapper">
        @include('partials.admin.sidebar')

        <main>
            @yield('content')
        </main>

        <footer class="mt-1">
            <div class="container">
                <hr />
                <p>&copy; {{ date('Y') }} <a href="https://ftbastler.github.com/BoNeMEAL">{{ trans('app.copyright') }}</a> &ndash; {{ trans('app.footerNotice') }}</p>
            </div>
        </footer>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')

    @include('partials.flash')
</body>
</html>
