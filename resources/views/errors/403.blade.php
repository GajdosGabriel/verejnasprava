<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Verejná správa') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/2bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

@include('modul.navigation')


<div class="container">
    <h1>Túto položku nemôžete vymazať.</h1>
    <h3>Ak sa domievate že ide o chybu, kontaktujte administrátora! Kod 403</h3>

  <a href="{{ url('/') }}"><button class="btn btn-primary btn-lg">Vrátiť sa späť</button></a>

</div>



<!-- Scripts -->
<script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
