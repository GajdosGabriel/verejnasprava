@extends('layouts.app')

@section('page-title', 'Zoznam príspevkov')

{{--@section('navigation')--}}
{{--    <x-navigation.navigationOrganization/> @endsection--}}
@section('navigation') @include('organizations.navigation') @endsection

@section('content')


    <div class="container p-6 mx-auto">

        <div class="flex justify-between">
            <h1 class="page-title">Ľudia</h1>
            <a class="btn btn-primary" href="{{ route('user.create', [$organization->id, $organization->slug ]) }}">Nový
                zamestnanec</a>
        </div>

        <table class="table-auto">
            <thead>
            <tr class="alert-info">
                <th class="px-4 py-2">Meno</th>
                <th class="px-4 py-2">Typ</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Panel</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border">{{ $user->full_name() }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('meet.index', [$user->id, $user->slug]) }}">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td class="px-4 py-2 border"><span class="badge badge-secondary">Aktívny</span><span
                            class="badge badge-secondary">Poslať pozvánku</span></td>
                    <td class="px-4 py-2 border">
                        @foreach($user->roles as $role)
                            <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>


                    {{--@can( 'update', $post)--}}
                    <td class="px-4 py-2 border">
                        <a class="p-0 nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog text-secondary"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{--                        <a class="dropdown-item" href="{{ route('zast.admin.edit', [$council->id, $council->slug]) }}">--}}
                            {{--                            <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>--}}
                            {{--                            Upraviť položku--}}
                            {{--                        </a>--}}
                            <div class="dropdown-divider"></div>
                            {{--                                <form action="{{ route('org.posts.delete', [$post->id, $post->slug]) }}" class="d-flex justify-content-between" id="delete-form" method="post">--}}
                            {{--                                    @csrf @method('DELETE')--}}
                            {{--                                    <a class="dropdown-item" href="#" onclick="get_form(this).submit(); return false">--}}
                            {{--                                        <i @if(Auth::id() === $post->user_id) @else style="font-size: 118%; color: grey" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>--}}
                            {{--                                        Zmazať--}}
                            {{--                                    </a>--}}
                            {{--                                </form>--}}
                        </div>
                    </td>
                    {{--@endcan--}}
                </tr>
            @empty
                {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
            @endforelse

            </tbody>
        </table>
    </div>


@endsection
