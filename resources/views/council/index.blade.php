@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

@section('content')


    <div class="container min-h-screen p-6 mx-auto">
        <council-table></council-table>
    </div>



@endsection
