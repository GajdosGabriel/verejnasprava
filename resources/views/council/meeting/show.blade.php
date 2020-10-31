@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


@section('navigation') @include('council.meeting.navigation') @endsection

{{--@section('navigation') @include('council.items.navigation') @endsection--}}

@section('content')

    <div class="lg:container lg:flex mx-auto lg:px-6 min-h-screen py-6">

        <div class="lg:w-3/4 px-4 md:px-6  mb-6">

            {{-- Vuex component--}}
            <meeting :pmeeting="{{ $meeting }}"></meeting>
            <notification-list></notification-list>
        </div>

        {{-- ASIDE --}}
        <div class="lg:w-1/4 md:px-6 px-4">
            <livewire:comments :meeting="$meeting"/>
        </div>

    </div>




@endsection
