@extends('layouts.app')
@section('page-title', 'Zoznam úloh')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

<x-page.container>

            <tasks-component></tasks-component>

{{--            <notification-list></notification-list>--}}

</x-page.container>

    @endsection

