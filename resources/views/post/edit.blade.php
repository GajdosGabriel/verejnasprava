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


        <x-page.page3_3>
            <div class="col-span-8 bg-white p-3">
                <form action="{{ route('posts.update', $post->id) }}" method="POST"
                    enctype="multipart/form-data">
                  @csrf @method('PUT')
                  @include('modul.errors')
                  @include('post.postform')
              </form>
            </div>

            <div class="col-span-4 bg-white p-3">
                <h3 class="text-lg mb-4"></h3>
            </div>

        </x-page.page3_3>


    </x-page.container>

@endsection


