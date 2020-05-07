@extends('layouts.app')
@section('page-title', 'Upraviť objednávku')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        {{--<h2>Edit objednávka</h2>--}}
        <form action="{{ route('order.update', [ $organization->id, $organization->slug ]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')

            {{--@include('order._form_header')--}}
{{--            @include('order._form_body_create')--}}
{{--            @include('order._form_bottom')--}}

            <order0 :order="{{ $order }}"></order0>
        </form>


@endsection

