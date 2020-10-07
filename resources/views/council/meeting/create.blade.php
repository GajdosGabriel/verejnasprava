@extends('layouts.app')
@section('page-title', 'Nové zasadnutie')
@section('navigation') <x-navigation.navigationMeeting /> @endsection

@section('content')




        <div class="container mx-auto p-6 min-h-screen">
            <h1 class="page-title">Vytvoriť zasadnutie</h1>
            <div class="max-w-lg">

                <form method="POST" action="{{ route('meet.store', [$council->id, $council->slug]) }}" enctype="multipart/form-data">
                    @csrf @method('POST')
                    @include('modul.errors')
                    @include('council.meeting._form')
                </form>

            </div>

        </div>


@endsection
