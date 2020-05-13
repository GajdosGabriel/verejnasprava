@extends('layouts.app')

@section('page-title', 'Zverejňovanie dokumentov')

@section('navigation')
    @include('public.navigation')
@endsection

@section('content')

{{--    @include('layouts.banner-top')--}}
    @include('layouts.banner-middle')

    <div class="col-md-12">
        <h3 class="text-center mt-5">Zverejňovanie dokladov</h3>

{{--        @include('modul.categoryList')--}}
        @include('post.post-table-predna')


        {{--    {!! $posts ->render() !!}--}}
    </div>


@endsection