@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')
    <h2>Všetci užívatelia</h2>

    <a class="btn btn-primary float-right" href="{{ route('user.create', [ auth()->user()->id, auth()->user()->slug]) }}">Nový člen</a>

    @include('user._userTable')

@endsection


