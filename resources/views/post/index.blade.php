@extends('layouts.app')
@section('page-title', 'Zoznam dokumentov')

@section('navigation') @include('organizations.navigation') @endsection
@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="w-full">


            <x-page.page-title>
                <x-slot name="title">
                    Zverejnené doklady
                </x-slot>

                @role('admin')
                <a class="btn btn-primary"
                   href="{{ route('posts.create') }}">Nový doklad
                </a>
                @endrole

            </x-page.page-title>


            <post-table/>


            {{--            @include('post.table_index')--}}
            {{--            <div class="my-6">--}}
            {{--                {{ $posts->links() }}--}}
            {{--            </div>--}}

        </div>
    </div>





@endsection
