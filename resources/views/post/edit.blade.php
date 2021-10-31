@extends('layouts.app')

@section('page-title', 'Upraviť dokument')

@section('navigation') @include('organizations.navigation') @endsection

{{-- @section('navigation') --}}
{{-- @include('organizations.navigation') --}}
{{-- @endsection --}}

@section('content')
    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Upraviť doklad
            </x-slot>

            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Späť</a>
        </x-page.page-title>


        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">
                <form action="{{ route('organizations.posts.update', [$post->organization_id, $post->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('modul.errors')
                    @include('post.postform')
                </form>
            </div>

            <div class="col-span-3 bg-white p-3">
                <h3 class="text-lg mb-4 border-b border-gray-200 text-gray-400">Doklady od firmy <span class="text-gray-800">{{ $post->contact->name }}</span></h3>
                @include('post._table_edit')
            </div>

        </x-page.page3_3>


    </x-page.container>

@endsection
