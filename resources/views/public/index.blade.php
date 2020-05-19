@extends('layouts.app')
@section('page-title', 'Zoznam dokladov')

@section('navigation') <x-navigation /> @endsection

@section('content')


    @include('layouts.banner-top')
    @include('layouts.banner-middle')

    <div class="col-12 text-center my-5 d-flex justify-content-center flex-column">
        <div><a href="{{ url('/register') }}" class="btn btn-primary">Začať zdarma bez záväzkov</a></div>
        <small class="text-secondary">Registrácia bez poplatkov</small>
    </div>

    <div class="col-md-12">

        <h3 class="text-center mt-5">Zoznam publikovaných dokladov</h3>

{{--        @include('modul.categoryList')--}}
        @include('post.post-table-predna')
        </div>

        {{--    {!! $posts ->render() !!}--}}



@endsection
