@extends('layouts.app')

@section('page-title', 'Publikované doklady')
@section('navigation') <x-navigation.navPublic /> @endsection

@section('content')

    <div class="col-md-12">
        <h3 class="text-center mt-5">Zoznam publikovaných dokladov  {{ $organization->name }}</h3>


        @include('modul.categoryList')
        @include('post.post-table-predna')


        {{--    {!! $posts ->render() !!}--}}
    </div>


@endsection
