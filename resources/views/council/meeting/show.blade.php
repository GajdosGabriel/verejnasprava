@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


    @section('navigation') @include('council.meeting.navigation') @endsection

    {{-- @section('navigation') @include('council.items.navigation') @endsection --}}

@section('content')




    <x-page.page3_3>

        <div class="col-span-4 bg-white p-3">
            {{-- Vuex component --}}
            <meeting :pmeeting="{{ $meeting }}"></meeting>
            <notification-list></notification-list>
        </div>

        <div class="col-span-4 bg-white p-3">
            {{-- Vuex component --}}
            <meeting-users :councilid="{{ $meeting->council_id }}"></meeting-users>
        </div>

        <div class="col-span-4 bg-white p-3">
            <livewire:comments :meeting="$meeting" />
        </div>
    </x-page.page3_3>




@endsection
