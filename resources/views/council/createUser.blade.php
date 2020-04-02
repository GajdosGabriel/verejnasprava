@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <h2>Nový člen pre: <strong>{{ $council->name }}</strong></h2>

        <form action="{{ route('zast.storeUser', [ $council->id, $council->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('POST')
            @include('user._userForm')
        </form>

@endsection

