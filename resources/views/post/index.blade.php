@extends('layouts.app')
@section('page-title', 'Zoznam dokumentov')

@section('navigation') @include('organizations.navigation') @endsection
@section('content')

    <x-page.container>

        <div class="w-full">


            <x-page.page-title>
                <x-slot name="title">
                    Zverejnené doklady
                </x-slot>

                @role('admin')
                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Nový doklad
                    </a>
                @endrole

            </x-page.page-title>

            <x-page.page3_3>
                <div class="col-span-12 bg-white p-3">
                    <post-table />
                </div>
            </x-page.page3_3>

            {{-- @include('post._table_index') --}}
            {{-- <div class="my-6"> --}}
            {{-- {{ $posts->links() }} --}}
            {{-- </div> --}}

        </div>
    </x-page.container>





@endsection
