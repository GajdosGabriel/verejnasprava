@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container min-h-screen p-3 mx-auto sm:flex">

        <item-show :pitem="{{ $item }}"></item-show>
        <notification-list></notification-list>

    </div>


@endsection
