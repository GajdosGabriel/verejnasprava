@extends('layouts.app')

@section('page-title', 'Všetci užívatelia')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') @include('user.navigation') @endsection --}}

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Všetci užívatelia
            </x-slot>

            {{-- Labels pri vyhľadávaní --}}
            @if (isset($council))
                <div class="mb-3 text-center">
                    <a href="{{ route('users.index') }}">
                        <span class="border-2 rounded-md border-gray-400 px-2 bg-red-600 hover:bg-red-500 text-gray-200 ">
                            {{ $council->name }} X</span>
                    </a>
                </div>
            @endif

            @role('admin')
                <a class="float-right btn btn-primary" href="{{ route('users.create') }}">Nový člen
                </a>
            @endrole
        </x-page.page-title>


        @include('user._userTable')

    </x-page.container>

@endsection
