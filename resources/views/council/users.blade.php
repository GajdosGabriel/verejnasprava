@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <div class="col-md-12">
    <h2>Členovia výboru: <strong>{{ $council->name }}</strong></h2>

    <a class="btn btn-primary float-right" href="{{ route('user.create', [$council->id, $council->slug]) }}">Nový člen</a>

    @include('user._userTable')

    </div>

@endsection