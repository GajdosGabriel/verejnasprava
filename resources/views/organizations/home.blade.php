@extends('layouts.app')

@section('page-title', 'Úvodná stránka')

{{--@section('navigation')--}}
{{--    <x-navigation.navigationOrganization/> @endsection--}}
@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">

        @role('admin')
        @include('organizations.modul_activator')
        @endrole




{{--        <div class="col-md-4">--}}
{{--            @can('admin')--}}
{{--                <h2>História aktivít</h2>--}}
{{--                <ul class="list-group">--}}
{{--                    @forelse($activities as $activity)--}}
{{--                        @include("organizations.activities.{$activity->type}")--}}
{{--                    @empty--}}
{{--                        <p>Bez záznamu</p>--}}
{{--                    @endforelse--}}
{{--                </ul>--}}
{{--            @endcan--}}
{{--        </div>--}}
    </div>


@endsection
