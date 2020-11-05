@extends('layouts.app')
@section('page-title', 'Zoznam dokumentov')

@section('navigation') @include('organizations.navigation') @endsection
@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="w-full">


            <div class="flex justify-between items-center pb-8">
                <h1 class="page-title">Zverejnené doklady</h1>
                @role('admin')
                <a class="btn btn-primary"
                   href="{{ route('posts.create') }}">Nový doklad
                </a>
                @endrole
            </div>

            <post-table/>


            {{--            @include('post.table_index')--}}
            {{--            <div class="my-6">--}}
            {{--                {{ $posts->links() }}--}}
            {{--            </div>--}}

        </div>
    </div>





@endsection
