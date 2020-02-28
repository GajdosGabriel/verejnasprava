@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        {{--<h2>Nová objednávka</h2>--}}
        <form action="{{ route('order.store', [ $organization->id, $organization->slug ]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('POST')

            @include('order._form_header')
            @include('order._form_body_create')
            @include('order._form_bottom')

        </form>

        {{--<order0 :order="{{ $organization }}" :contacts="{{ $contacts }}"></order0>--}}
@endsection

