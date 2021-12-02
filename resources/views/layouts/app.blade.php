<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', config('app.name'))</title>
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"> --}}
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> --}}


    @yield('recaptcha')

    @yield('script-header')

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <link href="https://unpkg.com/animate.css@3.5.1/animate.min.css" rel="stylesheet" type="text/css"> --}}

    @yield('stylesheet')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> --}}

    <script>
        window.App = {!! json_encode([
    'user' => Auth::user(),
    'signedIn' => Auth::check(),
    'baseUrl' => asset('/'),
]) !!};
    </script>

    @livewireStyles
</head>

<body class="bg-gray-100">
    @include ('modul.kodSledovania')
    @include ('modul.facebook_login')

    <div id="app" v-cloak>
        @section('navigation')

        @show

        <div class="">
            @yield('content')

            {{-- Errors --}}
            @include('modul.flash')
        </div>

        {{-- JS only --}}
        <notification-list></notification-list>
    </div>

    @include('layouts.footer')





    <script src="{{ mix('js/app.js') }}" defer></script>


    @livewireScripts
    @yield('script-down')

</body>

</html>
