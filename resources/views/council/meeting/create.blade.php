@extends('layouts.app')
@section('page-title', 'Nové zasadnutie')
@section('navigation')
    @include('council.meeting.navigation')
@endsection

@section('content')


        <h1>Vytvoriť zasadnutie zastupiteľstva</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('meet.store', [$council->id, $council->slug]) }}" enctype="multipart/form-data">
                            @csrf @method('POST')

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
