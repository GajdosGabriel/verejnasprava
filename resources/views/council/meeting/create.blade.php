@extends('layouts.app')
@section('page-title', 'Nové zasadnutie')
@section('navigation') @include('organizations.navigation') @endsection

@section('content')




    <x-page.container>
        <x-page.page-title>
            <x-slot name="title">
                Nové zasadnutie
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>

        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">

                <form method="POST" action="{{ route('councils.meetings.store', $council->id) }}"
                    enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council.meeting._form')
                </form>

            </div>

            <div class="col-span-3 bg-white p-3">
                {{-- aside --}}
            </div>
        </x-page.page3_3>

    </x-page.container>


@endsection
