@extends('layouts.app')

@section('page-title', 'Vytvoriť návrh')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') --}}
{{-- @include('council.items.navigation') --}}
{{-- @endsection --}}

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový návrh programu
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">

                <form method="POST" action="{{ route('meetings.items.store', $meeting->id) }}"
                    enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council.items._form')
                </form>

                @include('council.items._editor')

            </div>

            <div class="col-span-3 bg-white p-3">
            </div>
        </x-page.page3_3>

    </x-page.container>
@endsection
