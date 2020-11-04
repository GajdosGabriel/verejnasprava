@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


{{--@section('navigation') @include('organizations.navigation') @endsection--}}

@section('content')
    <div class="container mx-auto min-h-screen p-6">
    <h1>Nie ste autorizovaný.</h1>
    <h3>Ak sa domievate, že ide o chybu, kontaktujte administrátora! Kod 403</h3>

  <a href="{{ url('/') }}"><button class="btn btn-primary btn-lg">Vrátiť sa späť</button></a>

</div>


@endsection
