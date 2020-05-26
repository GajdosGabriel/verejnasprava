@extends('layouts.app')
@section('page-title', 'Zoznam zasadnutí')

@section('navigation') <x-navigationMeeting /> @endsection
{{--@section('navigation') @include('council.meeting.navigation') @endsection--}}

@section('content')


    <div class="container mx-auto p-6 min-h-screen">

        <div class=" flex justify-between">
        <h1 class="font-bold">Zoznam zasadnutí</h1>
            @can('delete')
                <a class="btn btn-blue" href="{{ route('meet.create', [auth()->user()->id, auth()->user()->slug ]) }}">Nové zasadnutie</a>
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
                        <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog text-secondary"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('meet.edit', [$council->id, $council->slug]) }}">
                                <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                                Upraviť položku
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('meet.delete', [$council->id, $council->slug]) }}" onclick="get_form(this).submit(); return false">
                                <i style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>
                                Zmazať
                            </a>
                        </div>
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
