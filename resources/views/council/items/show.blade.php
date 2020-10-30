@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')


@section('navigation') @include('council.items.navigation') @endsection

@section('content')

    <div class="container min-h-screen p-3 mx-auto sm:flex">

        <div class="md:w-3/4 xs:w-full">
            <item-show :pitem="{{ $item }}"></item-show>
        </div>

    </div>


@endsection
