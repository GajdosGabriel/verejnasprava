@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')


{{-- Návrhy bez meetingu vs návrh v meetings --}}
@if(isset($item->meetings[0]))
@section('navigation') @include('council.meeting.navigation', ['meeting' => $item->meetings[0]]) @endsection
@else
@section('navigation') @include('organizations.navigation') @endsection
@endif

@section('content')

    <div class="container min-h-screen p-3 mx-auto sm:flex">

        <item-show :pitem="{{ $item }}"></item-show>
        <notification-list></notification-list>

    </div>


@endsection
