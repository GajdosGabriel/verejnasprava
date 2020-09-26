@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

@section('content')


    <div class="container min-h-screen p-6 mx-auto">


        @forelse($councils as $council)
            <div class="mb-4">

                <div class="flex justify-between">
                    <h1 class="page-title">{{ $council->name }}</h1>
                    <div class="flex">
                        <a href="{{ route('zast.userList', [$council->id, $council->slug]) }}">
                            Stretnutí: {{ $council->users()->count() }}
                        </a>

                        @can('delete')
                            <nav-horizontal inline-template>
                                <div class="relative">
                                    <button @click="isOpen =! isOpen" class="focus:outline-none">
                                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                        </svg>


                                        <div v-if="isOpen"
                                             class="absolute right-0 z-10 flex flex-col w-auto py-1 text-sm bg-white border-2 border-gray-300 rounded shadow-md">

                                            {{-- Item Up button--}}
                                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                                               href="{{ route('zast.admin.edit', [$council->id, $council->slug]) }}"
                                               title="Upraviť položku">
                                                Upraviť položku
                                            </a>

                                            {{-- Item Down button--}}
                                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                                               href="{{ route('zast.admin.delete', [$council->id, $council->slug]) }}"
                                               title="Zmazať zastupiteľstvo">
                                                Zmazať
                                            </a>

                                            {{--                                            <div class="py-1"></div>--}}

                                        </div>
                                    </button>
                                </div>
                            </nav-horizontal>
                        @endcan
                    </div>

                </div>
                <div class="flex flex-col">
                    @forelse($council->meetings as $meeting)

                        <div class="flex justify-between hover:underline">
                            <div>
                                <a href="{{ route('item.index', [$council->id, $council->slug]) }}">
                                    {{  $meeting->name }}
                                </a>
                                <a href="{{ route('item.index', [$council->id, $council->slug]) }}">
                                    <strong>
                                        {{ $meeting->start_at->format('d. m. Y') }}
                                    </strong>
                                    {{ $meeting->start_at->format('H:i') }}
                                    hod.
                                </a>
                            </div>

                            <div class="cursor-pointer">
                                <a href="{{ route('item.index', [$council->id, $council->slug]) }}">
                                    Program ({{  $meeting->items->count() }})
                                </a>
                            </div>
                        </div>

                    @empty
                        Prázdne
                    @endforelse
                </div>
            </div>

        @empty
            <span>Zastupiteľstvá nie sú vytvorené.</span>
        @endforelse


    </div>



@endsection
