@extends('layouts.app')

@section('page-title', 'Nastavenia')

    @section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <x-page.page3_3>
        {{-- Section 1 --}}
        <div class="w-full col-span-4 bg-white">
            <user-edit inline-template>
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

                        <h3 class="fill-current text-lg">Osobné údaje</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z" />
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z" />
                        </svg>

                    </div>
                    <div v-if="show">
                        <form action="{{ route('users.update', [$user->id, $user->slug]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PATCH')
                            @include('modul.errors')
                            @include('user._userForm')
                            @include('user._userRoleForm')

                            {{-- Save button --}}
                            <div class="flex justify-between my-4">
                                <a href="{{ URL::previous() }}"
                                    class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
                                <button type="submit" class="btn btn-primary text-center">Uložiť</button>
                            </div>
                        </form>

                        {{-- @include('user.edit') --}}
                    </div>
                </div>
            </user-edit>
            @role('admin')
            <organization-edit inline-template :organization="{{ $organization }}">
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">
                    <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

                        <h3 class="fill-current text-lg">Firemnné údaje</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z" />
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z" />
                        </svg>

                    </div>
                    <div v-if="show">
                        @include('organizations.edit')
                    </div>
                </div>
            </organization-edit>

            <council-create inline-template>
                <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                    <div class="flex justify-between items-center cursor-pointer" @click="toggle">

                        <h3 class="fill-current text-lg">Zastupiteľstvá</h3>

                        <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path d="M7 10V2h6v8h5l-8 8-8-8h5z" />
                        </svg>

                        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z" />
                        </svg>

                    </div>
                    <div v-if="show">
                        <form method="POST" action="{{ route('organizations.councils.store', $organization->id) }}">
                            @csrf @method('POST')
                            @include('modul.errors')
                            @include('council._form')
                            @include('council._setup_form')

                            {{-- Save button --}}
                            <div class="flex justify-between my-4">
                                <a href="{{ URL::previous() }}"
                                    class="btn bg-gray-300 text-center text-gray-700 font-semibold border-2 border-gray-500">Späť</a>
                                <button type="submit" class="btn btn-primary text-center">Uložiť</button>
                            </div>

                        </form>
                    </div>
                </div>
            </council-create>

            @endrole

        </div>

        {{-- Section 2 --}}
        <div class="w-full col-span-4 bg-white">
            <div class="w-full col-span-4 bg-white">

                <a href="{{ route('organizations.tags.index', $organization->id) }}">
                    Tags
                </a>

            </div>
        </div>
        {{-- Section 3 --}}
        <div class="w-full col-span-4 bg-white"></div>
    </x-page.page3_3>


@endsection
