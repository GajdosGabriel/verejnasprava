@extends('layouts.app')
@section('page-title', 'Nové zasadnutie')
@section('navigation') @include('organizations.navigation') @endsection

@section('content')




        <div class="container mx-auto p-6 min-h-screen">
            <h1 class="page-title">Nové zasadnutie</h1>
            <div class="max-w-lg">

                <form method="POST" action="{{ route('councils.meetings.store', $council->id) }}" enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council.meeting._form')
                </form>

            </div>

        </div>


@endsection
