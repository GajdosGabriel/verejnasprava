@extends('layouts.app')
@section('page-title', 'Zoznam kontaktov')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        {{--<h3>Pridať dodávateľa</h3>--}}
        {{--<form action="{{ route('org.contact.store', [auth()->user()->id, auth()->user()->slug ]) }}" method="post">--}}
            {{--@csrf @method('POST')--}}
            {{--@include('organizations._form')--}}
        {{--</form>--}}

        <index-table  :contacts="{{ $organization->contacts }}" :organization="{{ $organization }}"></index-table>






    @endsection
