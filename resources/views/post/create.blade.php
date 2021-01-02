@extends('layouts.app')

@section('page-title', 'Vytvoriť zverejnenie')

@section('navigation') @include('organizations.navigation') @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container min-h-screen p-6 mx-auto ">

        <div class="flex justify-between md:w-2/3">
            <h1 class="page-title">Vytvoriť doklad</h1>
            <new-contact-button/>
        </div>


        <form class="md:w-2/3"
              action="{{ route('posts.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf @method('POST')
            @include('modul.errors')
            @include('post.postform')
        </form>


        <h3 class="mb-4  text-lg">Posledné pridané doklady</h3>

        @include('post.table_index')
    </div>

@endsection


