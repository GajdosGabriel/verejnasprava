@extends('layouts.app')

@section('page-title', 'Úvodná stránka')

{{--@section('navigation')--}}
{{--    <x-navigation.navigationOrganization/> @endsection--}}
@section('navigation') @include('organizations.navigation') @endsection

@section('content')

    <div class="container mx-auto min-h-screen p-6">
        <div class="max-w-sm m-5">
            <h2 class="text-lg">Plne funkčne</h2>

            <div
                class="mb-5 max-w-sm bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold"> Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</p>
                        <p class="text-sm">Modul zverejňovanie je plne funkčný. Môžete ho používať.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="max-w-sm m-5">
            <h2 class="text-lg">Už čoskoro</h2>

            <div
                class="mb-5 max-w-sm bg-blue-100 border-t-4 border-blue-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Online hlasovanie zastupiteľstvá</p>
                        <p class="text-sm">Už čoskoro!</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="max-w-sm m-5">
            <h2 class="text-lg">Pripravujeme</h2>

            <div
                class="mb-5 max-w-sm bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold"> Modul <a href="#" class="alert-link">objednávky!</a></p>
                        <p class="text-sm">Pripravujeme modul na vystavovanie, evidovanie a zasielanie objednávok.</p>
                    </div>
                </div>
            </div>


            <div
                class="mb-5 max-w-sm bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Evidencia dochádzky!</p>
                        <p class="text-sm">Modul Evidencia zamestnancov pripravujeme.</p>
                    </div>
                </div>
            </div>

            <div
                class="mb-5 max-w-sm bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Úlohy a termíny pre zamestnancov.</p>
                        <p class="text-sm">Modul umožní zadávť úlohy a sledovať termíny.</p>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-md-4">
            @can('admin')
                <h2>História aktivít</h2>
                <ul class="list-group">
                    @forelse($activities as $activity)
                        @include("organizations.activities.{$activity->type}")
                    @empty
                        <p>Bez záznamu</p>
                    @endforelse
                </ul>
            @endcan
        </div>
    </div>


@endsection
