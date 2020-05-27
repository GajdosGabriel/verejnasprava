@extends('layouts.app')

@section('page-title', 'Upraviť profil')

@section('navigation') <x-navigationUser /> @endsection

{{--@section('navigation')--}}
{{--    @include('user.navigation')--}}
{{--@endsection--}}

@section('content')

        <h2>Upraviť užívateľa</h2>

        <form action="{{ route('user.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('PATCH')
            @include('user._userForm')
        </form>

@endsection

