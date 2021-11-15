@extends('layouts.app')

@section('page-title', 'Upraviť užívateľa')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')


<x-page.container>



        <x-page.page-title>
            <x-slot name="title">
                Upraviť užívateľa
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        {{-- <h1 class="font-bold text-2xl">Upraviť užívateľa</h1> --}}

        <form class="" action="{{ route('users.update', [$user->id, $user->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf @method('PATCH')
            @include('modul.errors')

            <x-page.page3_3>
                <div class="col-span-4 bg-white p-3">
                    @include('user._userForm')
                    <div class="form-group">
                        <div class="flex justify-between my-3">
                            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
                            <button type="submit" class="btn btn-primary">Uložiť</button>
                        </div>
                    </div>
                </div>

                <div class="col-span-4 bg-white p-3">
                    @include('user._userRoleForm')
                    @include('user._permissionsForm')
                </div>

                <div class="col-span-4 bg-white p-3">
                    @include('tag._userTagsForm')

                </div>


            </x-page.page3_3>



        </form>



    </x-page.container>


@endsection
