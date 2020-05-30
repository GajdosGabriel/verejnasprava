@extends('layouts.app')
@section('page-title', 'Zoznam dokumentov')
@section('navigation') <x-navigationOrganization /> @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="flex justify-between items-center">
            <h1 class="font-bold">Zverejnené doklady</h1>
            <a class="btn btn-primary" href="{{ route('org.post.create', [auth()->user()->active_organization, auth()->user()->slug ]) }}">Nový doklad</a>
        </div>

        @include('post.table_index')
    </div>





@endsection
