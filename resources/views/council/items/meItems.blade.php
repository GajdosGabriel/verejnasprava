@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

{{--@section('navigation') @include('council.items.navigation') @endsection--}}

@section('content')

    <div class="lg:container lg:flex mx-auto lg:px-6 min-h-screen py-6">

        <div class="lg:w-3/4 px-4 md:px-6  mb-6">

            <div class="flex justify-between items-center pb-8">
                <h1 class="page-title">Moje návrhy</h1>
                <a class="btn btn-primary"
                   href="{{ route('item.create') }}">Nový návrh</a>
            </div>

        </div>

        {{-- ASIDE --}}
        <div class="lg:w-1/4 md:px-6 px-4">

        </div>

    </div>




@endsection
