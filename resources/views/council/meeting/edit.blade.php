@extends('layouts.app')
@section('page-title', 'Upraviť zasadnutie')
@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">



        <x-page.page-title>
            <x-slot name="title">
                Upraviť zastupiteľstvo
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('meetings.update', $meeting->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            @include('modul.errors')
                            @include('council.meeting._form')

                        </form>

                     </div>

                    <div class="col-md-4">

                    </div>

{{--                    Aside part--}}
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
