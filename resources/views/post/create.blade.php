@extends('layouts.app')

@section('page-title', 'Vytvoriť zverejnenie')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') --}}
{{-- @include('organizations.navigation') --}}
{{-- @endsection --}}

@section('content')
    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Nový doklad
            </x-slot>

            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Späť</a>

        </x-page.page-title>


        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">
                <form class="" action="{{ route('organizations.posts.store', $organization->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('post.postform')
                </form>


                <h3 class="mb-4  text-lg">Posledné pridané doklady</h3>

                @include('post._table_index')
            </div>

            <div class="col-span-3 bg-white p-3">
                <h3 class="text-lg mb-4 border-b border-gray-200">Posledný doklad od firmy</h3>
                @include('post._table_copy')
            </div>
        </x-page.page3_3>
    </x-page.container>

@endsection

