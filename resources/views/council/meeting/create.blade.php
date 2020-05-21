@extends('layouts.app')
@section('page-title', 'Nové zasadnutie')
@section('navigation') <x-navigationMeeting /> @endsection

@section('content')




        <div class="container mx-auto p-6 min-h-screen">
            <h1 class="font-bold">Vytvoriť zasadnutie</h1>
            <div class="col-md-12">
                <div class="md:w-full">

                    <form method="POST" action="{{ route('meet.store', [$council->id, $council->slug]) }}" enctype="multipart/form-data">
                        @csrf @method('POST')

                        @include('council.meeting._form')
                    </form>



                    <div class="col-md-4">

                    </div>

{{--                    Aside part--}}
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>


@endsection
