@extends('layouts.app')

@section('page-title', 'Kontakt profil')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')


    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Detail kontaktu
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>


        <x-page.page3_3>
            <div class="col-span-4 bg-white p-3">
                <div class="flex justify-between">
                    <span>Meno</span>
                    <strong>{{ $user->name }}</strong>
                </div>
                <div class="flex justify-between">
                    <span>Ulica</span>
                    <strong>{{ $user->street }}</strong>
                </div>
                <div class="flex justify-between">
                    <span>Mesto</span>
                    <strong>{{ $user->psc }} {{ $user->city }}</strong>
                </div>
                <div class="flex justify-between">
                    <span>Email</span>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Telefón</span>
                    <span>{{ $user->phone }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Dátum vytvorenia</span>
                    <span>{{ $user->created_at }}</span>
                </div>
            </div>

            <div class="col-span-8 bg-white p-3">
                <h3 class="text-lg mb-4">Doklady od <span class="font-semibold">{{ $user->name }}</span></h3>
               @include('post.table_index', ['posts' => $user->posts])
            </div>

        </x-page.page3_3>


    </x-page.container>


@endsection
