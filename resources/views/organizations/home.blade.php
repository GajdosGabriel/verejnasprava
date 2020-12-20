@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <x-page.page3_3>

        <div class="w-full col-span-4 bg-white">
            @role('admin')
                <x-oznamenia>
                    <h3 class="font-semibold mb-4 text-gray-700">Oznámenia od zamestnávateľa</h3>
                </x-oznamenia>
            @endrole
        </div>
        <div class="w-full col-span-4 bg-white"></div>
        <div class="col-span-4 bg-white">
            @role('admin')
{{--            Funkčné vue --}}
{{--            <menu-activators/>--}}
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
        </x-page.page3_3>

@endsection
