@extends('layouts.app')

@section('page-title', 'Home profil')

@section('navigation') <x-navigationUser /> @endsection

{{--@section('navigation') @include('user.navigation') @endsection--}}

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="flex justify-between">
            <h2 class="font-bold text-2xl">Všetci užívatelia</h2>
            <a class="btn btn-primary float-right" href="{{ route('user.create', [ auth()->user()->id, auth()->user()->slug]) }}">Nový člen</a>
        </div>



    @include('user._userTable')
    </div>

@endsection


