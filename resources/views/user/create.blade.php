@extends('layouts.app')

@section('navigation') <x-navigationUser /> @endsection
{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="md:w-1/2">
        <h1 class="font-bold text-2xl">Nový užívateľ</h1>

        <form action="{{ route('user.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errorsAndFlash')
            @include('user._userForm')
        </form>
        </div>

    </div>



@endsection

