@extends('layouts.app')

@section('page-title', 'Nastavenia')

@section('navigation') @include('organizations.navigation') @endsection


@section('content')
    <x-page.container>
        <x-page.page3_3>
            {{-- Section 1 --}}
            <div class="w-full col-span-4 bg-white">
                <user-edit inline-template>
                    <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                        <div class="flex justify-between items-center cursor-pointer hover:bg-gray-200" @click="toggle">

                            <h3 class="fill-current text-lg">Osobné údaje</h3>

                            <svg v-if="show" class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg v-else class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>


                        </div>
                        <div v-if="show">
                            <form action="{{ route('users.update', [$user->id]) }}" method="POST"
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
                    <council-create inline-template>
                        <div class="border-gray-400 border-2 p-3 hover:bg-gray-200">

                            <div class="flex justify-between items-center cursor-pointer" @click="toggle">

                                <h3 class="fill-current text-lg">Zastupiteľstvá</h3>

                                <svg v-if="show" class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>

                                <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
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
                    <tags-card></tags-card>
                </div>
            </div>
            {{-- Section 3 --}}
            <div class="w-full col-span-4 bg-white">
                <user-edit-form></user-edit-form>
                <organization-edit-form></organization-edit-form>
                <council-create-form></council-create-form>
            </div>
        </x-page.page3_3>
    </x-page.container>

@endsection
