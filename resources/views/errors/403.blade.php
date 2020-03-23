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

{{--@include('modul.navigation')--}}


<div class="container">
    <h1>Nie ste autorizovaný.</h1>
    <h3>Ak sa domievate že ide o chybu, kontaktujte administrátora! Kod 403</h3>

  <a href="{{ url('/') }}"><button class="btn btn-primary btn-lg">Vrátiť sa späť</button></a>

</div>



<!-- Scripts -->
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
