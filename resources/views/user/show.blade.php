@extends('layouts.app')

@section('page-title', 'Home profil')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')


    <x-page.container>



        <x-page.page-title>
            <x-slot name="title">
                Detail užívateľa
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        <form class="" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            @include('modul.errors')

            <x-page.page3_3>
                <div class="col-span-4 bg-white p-3">
                    <div class="flex justify-between">
                        <span>Meno</span>
                        <strong>{{ $user->full_name() }}</strong>
                    </div>

                    <div class="flex justify-between">
                        <span>Email</span>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Funkcia</span>
                        <span>{{ $user->employment }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Dátum vytvorenia</span>
                        <span>{{ $user->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pozvánka zaslaná</span>
                        <span>{{ $user->send_invitation }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Email potvrdený</span>
                        <span>{{ $user->email_verified_at }}</span>
                    </div>
                </div>

                <div class="col-span-4 bg-white p-3">
                    @role('admin')
                        @include('user._userRoleForm')
                        @include('user._permissionsForm')
                    @endrole
                </div>

                <div class="col-span-4 bg-white p-3">
                    @role('admin')
                        @include('tag._userTagsForm')
                    @endrole
                </div>


            </x-page.page3_3>



        </form>



    </x-page.container>


@endsection
