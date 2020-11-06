@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="md:w-1/2">
        <h1 class="font-bold text-2xl">Nový užívateľ</h1>

        <form action="{{ route('users.store', auth()->user()->active_organization) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('user._userForm')
            @include('user._userRoleForm')
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

