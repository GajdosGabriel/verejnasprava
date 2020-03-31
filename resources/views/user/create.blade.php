@extends('layouts.app')

@section('navigation')
    @include('organizations.workers.navigation')
@endsection

@section('content')

        <h2>Nový užívateľ</h2>

        <form action="{{ route('org.worker.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('POST')
            @include('user._userForm')
        </form>

@endsection

