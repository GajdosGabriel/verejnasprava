@extends('layouts.app')
@section('page-title', 'Nové zastupiteľstvo')
@section('navigation') <x-navigation.navigationOrganization /> @endsection

@section('content')




        <div class="container mx-auto p-6 min-h-screen">
            <h1 class="page-title">Založiť zastupiteľstvo</h1>
            <div class="col-md-12">
                <div class="md:w-1/2 ">
                    <form  method="POST" action="{{ route('zast.admin.store', [$organization->id, $organization->slug]) }}">
                        @csrf @method('POST')
                        @include('modul.errorsAndFlash')
                        @include('council._form')

                    </form>

                 </div>

            </div>
        </div>


@endsection
