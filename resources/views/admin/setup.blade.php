@extends('layouts.app')

@section('page-title', 'Nastavenia')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection


@section('content')

    <div class="container mx-auto min-h-screen p-6">


        <organization-edit></organization-edit>
        <user-edit></user-edit>

        <h3 class="text-lg cursor-pointer">Zamestnanci</h3>

    </div>


@endsection
