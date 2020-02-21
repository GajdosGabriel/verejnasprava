@extends('layouts.app')

@section('navigation')
    @include('home.navigation')
@endsection

@section('content')
    @include('layouts.banner-top')
    @include('layouts.banner-middle')

    <div class="col-md-12">
        <h1 style="color: brown" class="text-center">@if( !empty($user->company)) {{ $user->company }}@endif<small> Zoznam dokladov</small></h1>

        @include('modul.categoryList')
        {{--@include('post.post-table-predna')--}}


        {{--    {!! $posts ->render() !!}--}}
    </div>


@endsection
