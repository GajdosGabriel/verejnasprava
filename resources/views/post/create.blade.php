@extends('layouts.app')

@section('page-title', 'Vytvoriť zverejnenie')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
<x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový doklad
            </x-slot>

            <a href="{{ URL::previous() }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>


        <form class="md:w-2/3"
              action="{{ route('posts.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('post.postform')
        </form>


        <h3 class="mb-4  text-lg">Posledné pridané doklady</h3>

        @include('post._table_index')
    </x-page.container>

@endsection


