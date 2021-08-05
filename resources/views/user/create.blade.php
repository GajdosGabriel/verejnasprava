@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="">
            <x-page.page-title>
                <x-slot name="title">
                    Nový užívateľ
                </x-slot>

                <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
            </x-page.page-title>


            <form action="{{ route('users.store', auth()->user()->active_organization) }}" method="POST"
                enctype="multipart/form-data">
                @csrf @method('POST')
                @include('modul.errors')

                <x-page.page3_3>
                    <div class="col-span-4 bg-white p-3">
                        @include('user._userForm')
                        <div class="form-group">
                            <div class="flex justify-between my-3">
                                <div></div>
                                <button type="submit" class="btn btn-primary">Uložiť</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 bg-white p-3">
                        @include('user._userRoleForm')
                    </div>

                    <div class="col-span-4 bg-white p-3">
                        @include('user._permissionsForm')
                    </div>




                </x-page.page3_3>
            </form>
        </div>

    </div>



@endsection
