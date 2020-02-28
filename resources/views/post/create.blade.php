@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')
    <h1>Vytvoriť doklad</h1>
    <form action="{{ route('org.post.store', [auth()->user()->active_organization, auth()->user()->slug ]) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('POST')

        @include('post.postform')
    </form>


    <h3 class="mt-4">Posledné pridané doklady</h3>
{{--    @include('post.post-tableTri')--}}
@endsection


