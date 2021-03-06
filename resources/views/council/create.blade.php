@extends('layouts.app')
@section('page-title', 'Nové zastupiteľstvo')
@section('navigation') @include('organizations.navigation') @endsection

@section('content')




        <div class="container mx-auto p-6 min-h-screen">
            <h1 class="page-title">Založiť zastupiteľstvo</h1>
            <div class="col-md-12">
                <div class="md:w-1/2 ">
                    <form  method="POST" action="{{route('organizations.councils.store', $organization->id) }}">
                        @csrf @method('POST')
                        @include('modul.errors')
                        @include('council._form')
                        @include('council._setup_form')

                        {{-- Save button --}}
                        <div class="flex justify-between my-4">
                            <a href="{{ URL::previous() }}" class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
                            <button type="submit"  class="btn btn-primary text-center">Uložiť</button>
                        </div>
                    </form>

                 </div>

            </div>
        </div>


@endsection
