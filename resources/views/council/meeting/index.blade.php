@extends('layouts.app')
@section('page-title', 'Zoznam zasadnutí')

@section('navigation') <x-navigationMeeting /> @endsection
{{--@section('navigation') @include('council.meeting.navigation') @endsection--}}

@section('content')


    <div class="container mx-auto p-6 min-h-screen">

        <div class=" flex justify-between">
        <h1 class="font-bold">Zaasadnutia: {{ $council->name }}</h1>
            @can('delete')
                <a class="btn btn-primary" href="{{ route('meet.create', [auth()->user()->id, auth()->user()->slug ]) }}">Nové zasadnutie</a>
            @endcan
        </div>

        <table class="table-auto mt-4 rounded-lg">
            <thead class="bg-gray-300">
                <tr class="alert-info">
                    <th class="px-4 py-2">Dátum</th>
                    <th class="px-4 py-2">Popis</th>
                    <th class="px-4 py-2">Typ</th>
                    <th class="px-4 py-2">Vystavil</th>
                    <th class="px-4 py-2">Príloha</th>
                    <th class="px-4 py-2">Publikované</th>
                    <th class="px-4 py-2">Body rokovania</th>
                    @can('delete')
                    <th>Panel</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse($council->meetings as $council)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $council->start_at->format('d. m. Y') }} <strong>{{ $council->start_at->format('H:i') }} hod.</strong></td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('item.index', [$council->id, $council->slug]) }}">
                            {{ $council->name }}
                        </a>
                    </td>
                    <td class="border px-4 py-2">{{ $council->description }}</td>
                    <td class="border px-4 py-2">{{ $council->user->full_name() }}</td>
                    <td class="border px-4 py-2">
                        @forelse($council->files as $file)
                            <a target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                        @empty
                            Bez prílohy
                        @endforelse
                    </td>
                    <td class="border px-4 py-2">
                        @can('delete')
                        <a href="{{ route('meet.published', [ $council->id, $council->slug]) }}">
                            @if($council->published)
                            <span class="badge badge-secondary">Nezverejnené</span>
                            @else
                            <span class="badge badge-primary">Zverejnené</span>
                            @endif
                        </a>
                        @endcan
                    </td>
                    <td class="border px-4 py-2">{{ $council->items()->count() }}</td>

                    @can('delete')
                    <td class="border px-4 py-2">
                        <nav-horizontal inline-template>
                            <div class="relative flex items-start">
                                <a @click="isOpen =! isOpen" class="" href="#" >
                                    <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                                </a>

                                <div v-if="isOpen" class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                                    {{-- Item Up button--}}
                                    <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap" href="{{ route('meet.edit', [$council->id, $council->slug]) }}" title="Upraviť položku">
                                        Upraviť položku
                                    </a>

                                    {{-- Item Down button--}}
                                    <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap" href="{{ route('meet.delete', [$council->id, $council->slug]) }}" title="Vymazať položku">
                                        Zmazať
                                    </a>

{{--                                    <div class="dropdown-divider"></div>--}}
{{--                                    <form action="{{ route('org.post.delete', [$post->id, $post->slug]) }}" id="delete-form" method="post">--}}
{{--                                        @csrf @method('DELETE')--}}
{{--                                        <a class="hover:bg-gray-200 px-4 py-1 flex-1" href="#" onclick="get_form(this).submit(); return false">--}}
{{--                                            <i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>--}}
{{--                                            Zmazať--}}
{{--                                        </a>--}}
{{--                                    </form>--}}
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
