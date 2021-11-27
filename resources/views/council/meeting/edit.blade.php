@extends('layouts.app')
@section('page-title', 'Upraviť zasadnutie')
@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Upraviť zastupiteľstvo
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">

                <form method="POST" action="{{ route('meetings.update', $meeting->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('modul.errors')
                    @include('council.meeting._form')
                </form>

            </div>

            <div class="col-span-3 bg-white p-3">
                {{-- // --}}
            </div>
            
        </x-page.page3_3>

    </x-page.container>
@endsection
