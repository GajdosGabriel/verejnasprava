@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation')
    <x-navigationOrganization/> @endsection

@section('content')


    <div class="container min-h-screen p-6 mx-auto">
        <div class="flex justify-between">
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
                <th class="px-4 py-2">Typ</th>
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
                        <td class="px-4 py-2 border">

                            <nav-horizontal inline-template>
                                <div class="relative flex items-start">
                                    <a @click="isOpen =! isOpen" class="" href="#">
                                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                        </svg>
                                    </a>

                                    <div v-if="isOpen"
                                         class="absolute z-10 flex flex-col w-32 py-1 text-sm bg-white border-2 border-gray-300 rounded shadow-md">

                                        {{-- Item Up button--}}
                                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200"
                                           href="{{ route('zast.admin.edit', [$council->id, $council->slug]) }}"
                                           title="Upraviť položku">
                                            Upraviť položku
                                        </a>

                                        {{-- Item Down button--}}
                                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200"
                                           href="{{ route('zast.admin.delete', [$council->id, $council->slug]) }}"
                                           title="Zmazať zastupiteľstvo">
                                            Zmazať
                                        </a>

                                        <div class="py-1"></div>

                                        {{--                                <a class="px-4 hover:bg-gray-200" href="{{ route('item.delete', [$item->id, $item->slug]) }}">--}}
                                        {{--                                    <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>--}}
                                        {{--                                    Zmazať--}}
                                        {{--                                </a>--}}
                                        {{--                                <div class="dropdown-divider"></div>--}}
                                        {{--                                <a class="dropdown-item" href="{{ route('item.delete', [$item->id, $item->slug]) }}">--}}
                                        {{--                                    <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>--}}
                                        {{--                                    Zmazať--}}
                                        {{--                                </a>--}}

                                        {{--                                <form action="{{ route('org.post.delete', [$post->id, $post->slug]) }}" class="d-flex justify-content-between" id="delete-form" method="post">--}}
                                        {{--                                    @csrf @method('DELETE')--}}
                                        {{--                                    <a class="dropdown-item" href="#" onclick="get_form(this).submit(); return false">--}}
                                        {{--                                        <i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>--}}
                                        {{--                                        Zmazať--}}
                                        {{--                                    </a>--}}
                                        {{--                                </form>--}}
                                    </div>

                                </div>
                            </nav-horizontal>
                        </td>
                    @endcan

            </tr>
            @empty
                <td>Požiadať správcu o prístup.</td>
            @endforelse

            </tbody>
        </table>
    </div>



@endsection
