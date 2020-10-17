@extends('layouts.app')
@section('page-title', 'Upraviť zasadnutie')
@section('navigation') <x-navigation.navigationOrganization /> @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">




        <h1 class="page-title">Upraviť zastupiteľstvo</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('meet.update', [$meeting->id, $meeting->slug]) }}">
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
