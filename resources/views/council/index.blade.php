@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')


    <div class="container min-h-screen p-6 mx-auto">
        <div class="w-2/3">
            <council-table></council-table>
        </div>

    </div>



@endsection
