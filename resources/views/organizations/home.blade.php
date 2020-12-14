@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container md:grid grid-cols-12 gap-4 mx-auto min-h-screen p-6 bg-gray-200">

        <div class="w-full col-span-8">

        </div>
        <div class="col-span-4 bg-gray-100">
            @role('admin')
            @include('organizations.modul_activator')
            @endrole
        </div>






{{--        <div class="col-md-4">--}}
{{--            @role('admin')--}}
{{--                <h2>História aktivít</h2>--}}
{{--                <ul class="list-group">--}}
{{--                    @forelse($activities as $activity)--}}
{{--                        @include("organizations.activities.{$activity->type}")--}}
{{--                    @empty--}}
{{--                        <p>Bez záznamu</p>--}}
{{--                    @endforelse--}}
{{--                </ul>--}}
{{--            @endrole--}}
{{--        </div>--}}
    </div>


@endsection
