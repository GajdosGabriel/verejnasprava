@extends('layouts.app')
@section('page-title', 'Upraviť zastupiteľstvo')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') --}}
{{-- @include('organizations.navigation') --}}
{{-- @endsection --}}

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

                <form method="POST" action="{{ route('zast.admin.update', [$council->id, $council->slug]) }}">
                    @csrf @method('PUT')
                    @include('modul.errors')
                    @include('council._form')

                </form>

            </div>

            <div class="col-span-3 bg-white p-3">
                {{-- aside --}}
            </div>

        </x-page.page3_3>
    </x-page.container>
@endsection
