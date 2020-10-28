@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto min-h-screen p-6">
        <div class="flex justify-between">
            <h1 class="page-title">Členovia výboru: {{ $council->name }}</h1>
            <a class="btn btn-primary text-center" href="{{ route('user.create', [$council->id, $council->slug]) }}">Nový člen</a>
        </div>


    @include('user._userTable')

    </div>

@endsection
