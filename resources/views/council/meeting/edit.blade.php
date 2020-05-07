@extends('layouts.app')
@section('page-title', 'Upraviť zasadnutie')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


        <h1>Nové zastupiteľstvo</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('meet.update', [$meeting->id, $meeting->slug]) }}">
                            @csrf @method('PUT')

                            @include('council.meeting._form')

                        </form>

                     </div>

                    <div class="col-md-4">

                    </div>

{{--                    Aside part--}}
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        </div>


@endsection
