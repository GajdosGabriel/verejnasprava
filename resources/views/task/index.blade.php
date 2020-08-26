@extends('layouts.app')
@section('page-title', 'Zoznam úloh')

@section('navigation') <x-navigation.navigationOrganization /> @endsection

@section('content')

        <div class="container mx-auto min-h-screen p-6">

            <todo-component></todo-component>

            <notification-list></notification-list>

        </div>

    @endsection

