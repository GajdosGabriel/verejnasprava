@extends('layouts.app')

@section('page-title', 'Nálepky')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <div class="container min-h-screen p-6 mx-auto ">

        <x-page.page-title>
            <x-slot name="title">
                Zoznam nálepiek
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>

        <x-page.page3_3>
            {{-- Section 1 --}}
            <div class="w-full col-span-4 bg-white">
                <ul>
                    @foreach ($tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>

            </div>

            {{-- Section 2 --}}
            <div class="w-full col-span-4 bg-white">
            </div>

            {{-- Section 3 --}}
            <div class="w-full col-span-4 bg-white"></div>
        </x-page.page3_3>

    </div>
@endsection
