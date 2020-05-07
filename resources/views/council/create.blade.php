@extends('layouts.app')
@section('page-title', 'Nové zastupiteľstvo')
@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


        <h1>Založiť zastupiteľstvo</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('zast.store', [$organization->id, $organization->slug]) }}">
                            @csrf @method('POST')

                            @include('council._form')

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
