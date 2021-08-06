@extends('layouts.app')

@section('page-title', 'Upraviť dokument')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
<x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Upraviť doklad
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>


        <form action="{{ route('posts.update', $post->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('modul.errors')
            @include('post.postform')
        </form>
    </x-page.container>

@endsection


