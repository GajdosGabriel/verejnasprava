@extends('layouts.app')
@section('page-title', 'Vytvoriť objednávku')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        {{--<h2>Nová objednávka</h2>--}}
{{--        <form action="{{ route('order.store', [ $organization->id, $organization->slug ]) }}" method="POST" enctype="multipart/form-data">--}}
{{--            @csrf @method('POST')--}}

            {{--@include('order._form_header')--}}
{{--            @include('order._form_body_create')--}}
{{--            @include('order._form_bottom')--}}

{{--            <order0 :order="{{ $organization }}"></order0>--}}
            <order-group :order="{{ $organization }}"></order-group>
{{--        </form>--}}


@endsection

