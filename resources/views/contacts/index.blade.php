@extends('layouts.app')
@section('page-title', 'Zoznam kontaktov')

@section('navigation') <x-navigationOrganization /> @endsection
{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

        {{--<h3>Pridať dodávateľa</h3>--}}
        {{--<form action="{{ route('org.contact.store', [auth()->user()->id, auth()->user()->slug ]) }}" method="post">--}}
            {{--@csrf @method('POST')--}}
            {{--@include('organizations._form')--}}
        {{--</form>--}}

        <div class="container mx-auto min-h-screen p-6">
        <index-table  :contacts="{{ $organization->contacts }}" :organization="{{ $organization }}"></index-table>
        </div>






    @endsection
