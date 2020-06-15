@extends('layouts.app')

@section('page-title', 'Vytvoriť zverejnenie')

@section('navigation')
    <x-navigationOrganization/> @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container min-h-screen p-6 mx-auto">

        <h1 class="page-title">Vytvoriť doklad</h1>

        <form class="md:w-2/3"
              action="{{ route('org.post.store', [auth()->user()->active_organization, auth()->user()->slug ]) }}"
              method="POST" enctype="multipart/form-data">
            @csrf @method('POST')

            @include('post.postform')
        </form>


        <h3 class="mb-4  text-lg">Posledné pridané doklady</h3>

        @include('post.table_index')
    </div>

@endsection


