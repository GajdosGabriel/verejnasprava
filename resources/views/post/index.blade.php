@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')

        <h1 class="float-left">Organization posts</h1>
        <a class="btn btn-primary float-right" href="{{ route('org.post.create', [auth()->user()->active_organization, auth()->user()->slug ]) }}">Nový doklad</a>

        @include('post.table_index')


@endsection