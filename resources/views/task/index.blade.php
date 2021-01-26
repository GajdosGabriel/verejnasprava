@extends('layouts.app')
@section('page-title', 'Zoznam úloh')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

        <div class="container mx-auto min-h-screen p-6">

            <tasks-component></tasks-component>

{{--            <notification-list></notification-list>--}}

        </div>

    @endsection

