@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

@section('content')


    <div class="container min-h-screen p-6 mx-auto">

        <div class="flex justify-between mb-8">
            <h1 class="page-title">Vaše zastupiteľstvá</h1>
            @can('delete')
                <a class="btn btn-primary"
                   href="{{ route('zast.admin.create', [auth()->user()->active_organization, auth()->user()->slug ]) }}">Nové
                    zastupiteľvo</a>
            @endcan
        </div>

        <table class="table-auto min-w-full">
            <thead class="bg-gray-300">
            <tr class="alert-info">
                <th class="px-4 py-2">Popis</th>
                <th class="px-4 py-2">Obdobie</th>
                <th class="px-4 py-2">Počet zasadnutí</th>
                <th class="px-4 py-2">Počet členov</th>
                @can('delete')
                    <th class="px-4 py-2">Panel</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            <tr class="hover:bg-gray-100">
                @forelse($councils as $council)
                    <td class="px-4 py-2 border">
                        <a href="{{ route('meet.index', [$council->id, $council->slug]) }}">
                            {{ $council->name }}
                        </a>
                    </td>
                    <td class="px-4 py-2 border">{{ $council->description }}</td>
                    <td class="px-4 py-2 border">{{ $council->meetings()->count() }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('zast.userList', [$council->id, $council->slug]) }}">
                            {{ $council->users()->count() }}
                        </a>
                    </td>

                    @can('delete')
                        <td class="px-4 py-2 border text-center">

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
                        </td>
                    @endcan

            </tr>
            @empty
                <td>Zastupiteľstvá nie sú vytvorené.</td>
            @endforelse

            </tbody>
        </table>
    </div>



@endsection
