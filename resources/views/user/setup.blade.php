@extends('layouts.app')

@section('page-title', 'Nastavenia')

@section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <div class="container mx-auto min-h-screen p-6">
        <div class="sm:w-2/3">

            @role('admin')
            <organization-edit inline-template :organization="{{ $organization }}">
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">
                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

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
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                    <div class="flex justify-between items-center cursor-pointer" @click="toggle">

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
                        <form  method="POST" action="{{ route('council.store', [$organization->id, $organization->slug]) }}">
                            @csrf @method('POST')
                            @include('modul.errors')
                            @include('council._form')
                        </form>
                    </div>
                </div>
            </council-edit>
            @endrole
            <user-edit inline-template>
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

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
                            @include('user._userRoleForm')

                            {{-- Save button --}}
                            <div class="flex justify-between my-4">
                                <a href="{{ URL::previous() }}" class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
                                <button type="submit"  class="btn btn-primary text-center">Uložiť</button>
                            </div>
                        </form>

{{--                        @include('user.edit')--}}
                    </div>
                </div>
            </user-edit>

            <div class="flex justify-between items-center p-2">

                <h3 class="fill-current text-lg">Aktívne moduly</h3>
                <span>Pripravujeme</span>

            </div>


        </div>
    </div>


@endsection
