@extends('layouts.app')

@section('page-title', 'Vytvoriť zverejnenie')

@section('navigation') <x-navigationOrganization /> @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container mx-auto p-6 min-h-screen">

    <h1 class="font-bold mb-4 text-2xl text-gray-700">Vytvoriť doklad</h1>

    <form class="md:w-2/3" action="{{ route('org.post.store', [auth()->user()->active_organization, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('POST')

        @include('post.postform')
    </form>


    <h3 class="font-bold mb-4 text-center text-l">Posledné pridané doklady</h3>

    @include('post.table_index')
    </div>

@endsection


