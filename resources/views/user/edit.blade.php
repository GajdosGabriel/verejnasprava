@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <h2>Upraviť užívateľa</h2>

        <form action="{{ route('user.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
           @csrf @method('PATCH')
            @include('user._userForm')
        </form>

@endsection

