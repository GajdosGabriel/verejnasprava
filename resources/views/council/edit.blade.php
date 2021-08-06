@extends('layouts.app')
@section('page-title', 'Upraviť zastupiteľstvo')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

<x-page.container>

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
                        <form method="POST" action="{{ route('zast.admin.update', [$council->id, $council->slug]) }}">
                            @csrf @method('PUT')
                            @include('modul.errors')
                            @include('council._form')

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

    </x-page.container>
@endsection
