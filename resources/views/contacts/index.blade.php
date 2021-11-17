@extends('layouts.app')
@section('page-title', 'Zoznam kontaktov')

@section('navigation') @include('organizations.navigation') @endsection
{{-- @section('navigation') --}}
{{-- @include('organizations.navigation') --}}
{{-- @endsection --}}

@section('content')

    {{-- <h3>Pridať dodávateľa</h3> --}}
    {{-- <form action="{{ route('org.contact.store', [auth()->user()->id, auth()->user()->slug ]) }}" method="post"> --}}
    {{-- @csrf @method('POST') --}}
    {{-- @include('organizations._form') --}}
    {{-- </form> --}}

    <x-page.container>

        <x-page.page3_3>
            <div class="col-span-12 bg-white p-3">
                <contact-table />
            </div>

        </x-page.page3_3>

    </x-page.container>
    <notification-list></notification-list>
@endsection
