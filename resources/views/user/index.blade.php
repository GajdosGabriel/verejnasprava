@extends('layouts.app')

@section('page-title', 'Home profil')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation') @include('user.navigation') @endsection--}}

@section('content')

    <div class="container min-h-screen p-6 mx-auto">

        <div class="">
        <div class="flex justify-between my-8">
            <h2 class="text-2xl font-semibold">Všetci užívatelia</h2>
            @role('admin')
            <a class="float-right btn btn-primary"
               href="{{ route('users.create') }}">Nový člen
            </a>
            @endrole
        </div>

        @include('user._userTable')
        </div>
    </div>

@endsection


