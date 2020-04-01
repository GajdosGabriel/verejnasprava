@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <h1>Členovia výboru</h1>
    @include('user.index')

@endsection
