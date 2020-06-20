@extends('layouts.app')

@section('page-title', 'Upraviť dokument')

@section('navigation') <x-navigationOrganization /> @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')
    <div class="container mx-auto p-6 min-h-screen">

        <h1 class="page-title">Upraviť doklad</h1>
        <form action="{{ route('org.post.update', [$post->id, $post->slug ]) }}" method="POST"
              enctype="multipart/form-data">
            @csrf @method('PUT')

            @include('post.postform')
        </form>
    </div>

@endsection


