@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation') <x-navigationOrganization /> @endsection

@section('content')



    <div class="container mx-auto min-h-screen p-6">
        <div class="flex justify-between">
            <h1 class="font-bold text-2xl">Vaše zastupiteľstvá</h1>
            @can('delete')
                <a class="btn btn-primary" href="{{ route('zast.create', [auth()->user()->active_organization, auth()->user()->slug ]) }}">Nové zastupiteľvo</a>
            @endcan
        </div>

        <table class="table-auto">
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
                @forelse($organization->councils as $council)
                    <td class="border px-4 py-2">
                        <a href="{{ route('meet.index', [$council->id, $council->slug]) }}">
                            {{ $council->name }}
                        </a>
                    </td>
                    <td class="border px-4 py-2">{{ $council->description }}</td>
                    <td class="border px-4 py-2">{{ $council->meetings()->count() }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('zast.userList', [$council->id, $council->slug]) }}">
                            {{ $council->users()->count() }}
                        </a>
                    </td>

                @can('delete')
                <td class="border px-4 py-2">

                    <nav-horizontal inline-template>
                        <div class="relative flex items-start">
                            <a @click="isOpen =! isOpen" class="" href="#" >
                                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                            </a>

                            <div v-if="isOpen" class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                                {{-- Item Up button--}}
                                <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap" href="{{ route('zast.edit', [$council->id, $council->slug]) }}" title="Upraviť položku">
                                    Upraviť položku
                                </a>

                                {{-- Item Down button--}}
                                <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap" href="{{ route('zast.delete', [$council->id, $council->slug]) }}" title="Zmazať zastupiteľstvo">
                                    Zmazať
                                </a>

                                <div class="py-1"></div>

{{--                                <a class="hover:bg-gray-200 px-4" href="{{ route('item.delete', [$item->id, $item->slug]) }}">--}}
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
                {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
            @endforelse

            </tbody>
        </table>
    </div>



@endsection
