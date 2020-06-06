@extends('layouts.app')

@section('page-title', 'Zverejňovanie dokumentov')

@section('navigation')
    <x-navigation/> @endsection

@section('content')

    {{--    @include('layouts.banner-top')--}}
    {{--    @include('layouts.banner-middle')--}}

    <div class="container w-full min-h-screen p-6 mx-auto">

        <div class="card">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.youtube.com/embed/sXCDTYenouQ" width="100%" frameborder="0"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
        </div>


        <div class="text-center mt-8">
            <div class="mb-2"><a href="{{ url('/register') }}" class="btn btn-primary mb-1">Začať zdarma bez záväzkov</a></div>
            <small class="text-secondary">Registrácia bez poplatkov</small>
        </div>




    <h3 class="font-semibold text-2xl text-center mt-12 mb-6">Zverejnené doklady</h3>
    {{--        @include('modul.categoryList')--}}
    @include('post.post-table-predna')


    {{--    {!! $posts ->render() !!}--}}

    </div>

@endsection
