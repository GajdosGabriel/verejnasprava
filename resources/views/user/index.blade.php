@extends('layouts.app')

@section('page-title', 'Home profil')

    @section('navigation') @include('organizations.navigation') @endsection

    {{-- @section('navigation') @include('user.navigation') @endsection --}}

@section('content')

    <x-page.container>

        <div class="">

            <x-page.page-title>
                <x-slot name="title">
                    Všetci užívatelia
                </x-slot>

                @role('admin')
                <a class="float-right btn btn-primary" href="{{ route('users.create') }}">Nový člen
                </a>
                @endrole
            </x-page.page-title>


            @include('user._userTable')
        </div>
    </x-page.container>

@endsection
