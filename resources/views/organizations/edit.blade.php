@extends('layouts.app')

@section('page-title', 'Upraviť dokument')

@section('navigation') <x-navigationOrganization /> @endsection


@section('content')

    <div class="container mx-auto p-6 min-h-screen">

    <h1 class="font-bold">Organization edit</h1>

    <form action="{{ route('org.update', [ $organization->id, $organization->slug ]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('organizations._form')

    </form>
    </div>

@endsection
