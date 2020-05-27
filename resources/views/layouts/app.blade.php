<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', config('app.name'))</title>


    @yield('recaptcha')

    @yield('script-header')

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css">

    @yield('stylesheet')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    @livewireStyles
</head>
<body>
    <div id="app">
        @section('navigation')

        @show

        <div class="">
            @yield('content')

            {{--Errors--}}
            @include('modul.errorsAndFlash')
        </div>
    </div>

@include('layouts.footer')


<script src="{{ mix('js/app.js') }}" defer></script>


@livewireScripts
@yield('script-down')


</body>
</html>
