@extends('layouts.app')
@section('page-title', 'Zoznam dokumentov')
@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

@section('content')

    <div class="container mx-auto p-6 min-h-screen">

        <div class="w-full">


            <div class="flex justify-between items-center pb-8">
                <h1 class="page-title">Zverejnené doklady</h1>
                <a class="btn btn-primary"
                   href="{{ route('post.create') }}">Nový doklad</a>
            </div>

            <post-table/>


{{--            @include('post.table_index')--}}
{{--            <div class="my-6">--}}
{{--                {{ $posts->links() }}--}}
{{--            </div>--}}

        </div>
    </div>





@endsection
