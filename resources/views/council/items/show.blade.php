@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')


{{-- Návrhy bez meetingu vs návrh v meetings --}}
@if (isset($item->meetings[0]))
    @section('navigation') @include('council.meeting.navigation', ['meeting' => $item->meetings[0]]) @endsection
@else
    @section('navigation') @include('organizations.navigation') @endsection
@endif

@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Návrhy
            </x-slot>

            <a class="btn btn-primary" href="{{ route('items.create') }}">Nový návrh</a>

        </x-page.page-title>


        <item-show :pitem="{{ $item }}"></item-show>



        <notification-list></notification-list>


    </x-page.container>


@endsection
