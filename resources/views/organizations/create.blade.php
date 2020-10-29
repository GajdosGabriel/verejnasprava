@extends('layouts.app')

@section('page-title', 'Vytvoriť organizáciu')


@section('navigation') @include('user.navigation') @endsection


@section('content')
    <div class="container mx-auto p-6 min-h-screen">

        <div class="md:w-1/2">
            <h2 class="page-title">Vytvoriť organizáciu</h2>
            <form action="{{ route('org.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf @method('POST')
                @include('modul.errors')
                @include('organizations._form')
            </form>
        </div>
    </div>
@endsection
[
