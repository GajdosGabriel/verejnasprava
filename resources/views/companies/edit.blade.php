@extends('layouts.app')

@section('content')

    <h1>Upraviť dodávateľa</h1>

    <form action="" method="POST" class="form-control">
        @csrf @method('PUT')

        @include('organizations._form')

    </form>

    @endsection