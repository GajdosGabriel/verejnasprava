@extends('layouts.app')

@section('page-title', 'Home profil')

@section('navigation') @include('organizations.navigation') @endsection


@section('content')


    <div class="container mx-auto min-h-screen p-6">

        <div class="md:w-1/2">

            <h1 class="font-bold text-2xl">Upraviť užívateľa</h1>

            <form class="p-3" action="{{ route('users.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                @include('modul.errors')
                @include('user._userForm')
                @include('user._userRoleForm')
                @include('tag._userTagsForm')
                @include('user._permissionsForm')
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
