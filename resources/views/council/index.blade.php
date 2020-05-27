@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation') <x-navigationOrganization /> @endsection

@section('content')



    <div class="container mx-auto min-h-screen p-6">
        <div class="flex justify-between">
            <h1 class="font-bold text-2xl">Vaše zastupiteľstvá</h1>
            @can('delete')
                <a class="btn btn-blue" href="{{ route('zast.create', [auth()->user()->active_organization, auth()->user()->slug ]) }}">Nové zastupiteľvo</a>
            @endcan
        </div>

        <table class="table-auto">
            <thead>
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
                    <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog text-secondary"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('zast.edit', [$council->id, $council->slug]) }}">
                            <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                            Upraviť položku
                        </a>
                        <a class="dropdown-item" href="{{ route('user.create', [$council->id, $council->slug]) }}">
                            <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                            Pridať člena
                        </a>
                        <div class="dropdown-divider"></div>
    {{--                                <form action="{{ route('org.post.delete', [$post->id, $post->slug]) }}" class="d-flex justify-content-between" id="delete-form" method="post">--}}
    {{--                                    @csrf @method('DELETE')--}}
    {{--                                    <a class="dropdown-item" href="#" onclick="get_form(this).submit(); return false">--}}
    {{--                                        <i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>--}}
    {{--                                        Zmazať--}}
    {{--                                    </a>--}}
    {{--                                </form>--}}
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
