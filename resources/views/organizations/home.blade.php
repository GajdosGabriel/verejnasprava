@extends('layouts.app')

@section('page-title', 'Úvodná stránka')


@section('navigation') @include('organizations.navigation') @endsection

@section('content')
    <x-page.container>
        <x-page.page3_3>

            <div class="col-span-4 bg-white">
                @role('admin')
                    <x-oznamenia>

                        <tasks-component></tasks-component>

                        <home-card-meeting></home-card-meeting>

                    </x-oznamenia>
                @endrole
            </div>
            <div class="col-span-4 bg-white">
                @role('admin')
                    <x-oznamenia>
                        {{-- <messenger-mails-card-user></messenger-mails-card-user> --}}

                       
                    </x-oznamenia>



                @endrole
                {{-- @role('admin') --}}
                {{-- <h2>História aktivít</h2> --}}
                {{-- <ul class="list-group"> --}}
                {{-- @forelse($activities as $activity) --}}
                {{-- @include("organizations.activities.{$activity->type}") --}}
                {{-- @empty --}}
                {{-- <p>Bez záznamu</p> --}}
                {{-- @endforelse --}}
                {{-- </ul> --}}
                {{-- @endrole --}}
            </div>

            <div class="col-span-4 bg-white">
                @role('admin')
                    {{-- Funkčné vue --}}
                    <x-oznamenia>
                        <activator-modules></activator-modules>
                    </x-oznamenia>

                    <x-oznamenia>
                        <messenger-card></messenger-card>

                    </x-oznamenia>
                @endrole


            </div>


        </x-page.page3_3>
    </x-page.container>
@endsection
