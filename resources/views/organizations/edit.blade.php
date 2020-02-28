@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <h1>Organization edit</h1>

    <form action="{{ route('org.update', [ $organization->id, $organization->slug ]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('organizations._form')

    </form>

@endsection