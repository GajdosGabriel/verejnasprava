@extends('layouts.app')

@section('page-title', 'Upraviť profil')

@section('navigation') <x-navigationUser /> @endsection

{{--@section('navigation')--}}
{{--    @include('user.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <div class="w-1/2">

            <h1 class="font-bold text-2xl">Upraviť užívateľa</h1>

            <form action="{{ route('user.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                @include('user._userForm')
            </form>

        </div>

    </div>


@endsection

