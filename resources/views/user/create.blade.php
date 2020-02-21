@extends('layouts.app')

@section('navigation')
    @include('user.navigation')
@endsection

@section('content')

        <h2>Vytvoriť organizáciu</h2>
        <form action="{{ route('organization.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('POST')
            @include('organizations._form')
        </form>

@endsection

