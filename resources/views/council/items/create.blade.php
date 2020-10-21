@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

{{--@section('navigation')--}}
{{--    @include('council.items.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        <h1 class="page-title">Nový bod programu</h1>

        <form method="POST" action="{{ route('item.store') }}"
              enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('council.items._form')
        </form>

        @include('council.items._editor')

    </div>
@endsection
