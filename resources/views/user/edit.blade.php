@extends('layouts.app')

@section('page-title', 'Home profil')

@section('navigation') @include('user.navigation') @endsection


@section('content')


    <div class="container mx-auto min-h-screen p-6">

        <div class="md:w-1/2">

            <h1 class="font-bold text-2xl">Upraviť užívateľa</h1>

            <form action="{{ route('user.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                @include('modul.errors')
                @include('user._userForm')
                @include('user._userRoleForm')
                <div class="form-group">
                    <div class="flex justify-between my-3">
                        <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
                        <button type="submit" class="btn btn-primary">Uložiť</button>
                    </div>
                </div>
            </form>

        </div>

    </div>


@endsection
