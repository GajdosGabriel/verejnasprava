@extends('layouts.app')

@section('content')

        <h2>Nová objednávka</h2>
        <form action="{{ route('order.store', [ auth()->user()->id, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
            @include('order._form_top')
            <order></order>
        </form>

@endsection

