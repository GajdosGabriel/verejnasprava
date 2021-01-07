@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <x-page.page3_3>

        <div class="col-span-4 bg-white">
            @role('super-admin')
            <x-oznamenia>

            </x-oznamenia>
            @endrole
        </div>
        <div class="col-span-4 bg-white">
            @role('super-admin')
            <x-oznamenia>
                <card-mails-user/>
            </x-oznamenia>



            @endrole
            {{--            @role('admin')--}}
            {{--            <h2>História aktivít</h2>--}}
            {{--            <ul class="list-group">--}}
            {{--                @forelse($activities as $activity)--}}
            {{--                @include("organizations.activities.{$activity->type}")--}}
            {{--                @empty--}}
            {{--                    <p>Bez záznamu</p>--}}
            {{--                @endforelse--}}
            {{--            </ul>--}}
            {{--            @endrole--}}
        </div>

        <div class="col-span-4 bg-white">
            @role('admin')
            {{-- Funkčné vue --}}
            <x-oznamenia>
                <menu-activators/>
            </x-oznamenia>
            {{--    @include('organizations.modul_activator')--}}
            @endrole

            @role('super-admin')
            <x-oznamenia>
                <messenger-card/>
            </x-oznamenia>
            @endrole


        </div>


    </x-page.page3_3>

@endsection
