@extends('layouts.app')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="md:w-1/2">
        <h1 class="font-bold text-2xl">Nový užívateľ</h1>

        <form action="{{ route('user.store', [ auth()->user()->active_organization, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('user._userForm')
            @include('user._userRoleForm')
        </form>
        </div>

    </div>



@endsection

