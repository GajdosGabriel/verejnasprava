@extends('layouts.app')

@section('page-title', 'Nastavenia')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection


@section('content')

    <div class="container mx-auto min-h-screen p-6">
        <div class="w-2/3">

            @role('admin')
            <organization-edit inline-template :organization="{{ $organization }}">
                <div>
                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200 p-2" @click="toggle">

                        <h3 class="fill-current text-lg">Firemnné údaje</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
                        </svg>

                    </div>
                    <div v-if="show">
                        @include('organizations.edit')
                    </div>
                </div>
            </organization-edit>

            <council-edit inline-template>
                <div>

                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200 p-2" @click="toggle">

                        <h3 class="fill-current text-lg">Zastupiteľstvá</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
                        </svg>

                    </div>
                    <div v-if="show">
                        <form  method="POST" action="{{ route('zast.admin.store', [$organization->id, $organization->slug]) }}">
                            @csrf @method('POST')
                            @include('modul.errors')
                            @include('council._form')
                        </form>
                    </div>
                </div>
            </council-edit>
            @endrole
            <user-edit inline-template>
                <div>

                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200 p-2" @click="toggle">

                        <h3 class="fill-current text-lg">Osobné údaje</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
                        </svg>

                    </div>
                    <div v-if="show">
                        <form action="{{ route('user.update', [ $user->id, $user->slug ]) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PATCH')
                            @include('modul.errors')
                            @include('user._userForm')
                        </form>

{{--                        @include('user.edit')--}}
                    </div>
                </div>
            </user-edit>

            <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200 p-2">

                <h3 class="fill-current text-lg">Zamestnanci</h3>
                <span>Pripravujeme</span>

            </div>


        </div>
    </div>


@endsection
