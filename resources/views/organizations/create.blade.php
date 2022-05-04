@extends('layouts.app')

@section('page-title', 'Vytvoriť organizáciu')


    @section('navigation') @include('user.navigation') @endsection


@section('content')
    <x-page.container>

        <div class="md:w-1/2">
            <h2 class="page-title">Vytvoriť organizáciu</h2>
            <form action="{{ route('user.organization.store', auth()->user()->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('POST')
                @include('modul.errors')
                @include('organizations._form')
            </form>
        </div>
    </x-page.container>
@endsection
