<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Verejná správa') }}</title>

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">

    @yield('stylesheet')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @section('navigation')
        @include('layouts.navigation')
        @show

        <div class="container">
            @yield('content')

            {{--Errors--}}
            @include('modul.errorsAndFlash')
        </div>
    </div>


<script src="{{ mix('js/app.js') }}" defer></script>
{{--<script>--}}
    {{--$('div.alert').not('.alert-important').delay(3900).fadeOut(350);--}}
{{--</script>--}}

@yield('script')

</body>
</html>
