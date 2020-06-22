@extends('layouts.app')
@section('page-title', 'Upraviť zastupiteľstvo')

@section('navigation') <x-navigationOrganization /> @endsection

{{--@section('navigation')--}}
{{--    @include('organizations.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="container mx-auto p-6 min-h-screen">
    <h1 class="page-title">Upraviť zastupiteľstvo</h1>



        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('zast.admin.update', [$council->id, $council->slug]) }}">
                            @csrf @method('PUT')
                            @include('modul.errorsAndFlash')
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

    </div>
@endsection
