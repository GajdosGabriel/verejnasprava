@extends('layouts.app')

@section('navigation')
    @include('user.navigation')
@endsection

@section('content')

        <h2>User Home</h2>

        <div class="alert alert-primary" role="alert">
            Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</a>!
        </div>
        <div class="alert alert-secondary" role="alert">
            Vystavovať <a href="#" class="alert-link">objednávky!</a>
        </div>
        <div class="alert alert-success" role="alert">
            Evidencia <a href="#" class="alert-link">zamestnancov!</a>
        </div>
        <div class="alert alert-danger" role="alert">
            Evidencia <a href="#" class="alert-link">dane a poplatky!</a>
        </div>

@endsection

