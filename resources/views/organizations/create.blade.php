@extends('layouts.app')

@section('page-title', 'Vytvoriť organizáciu')

@section('navigation') <x-navigation.navigationUser /> @endsection

@section('content')

        <h2 class="page-title">Vytvoriť organizáciu</h2>
        <form action="{{ route('org.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('POST')
            @include('modul.errorsAndFlash')
            @include('organizations._form')
        </form>

@endsection

