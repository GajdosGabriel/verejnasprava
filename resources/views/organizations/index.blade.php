@extends('layouts.app')

@section('page-title', 'Zoznam príspevkov')

@section('navigation') <x-navigationOrganization /> @endsection
{{--@section('navigation') @include('organizations.navigation') @endsection--}}

@section('content')

    <h1>Ľudia</h1>
    <div class="col-md-12">
        <a class="btn btn-primary float-right" href="{{ route('user.create', [$organization->id, $organization->slug ]) }}">Nový zamestnanec</a>

        <table class="table table-bordered table-inverse table-hover">
            <thead>
            <tr class="alert-info">
                <th>Meno</th>
                <th>Typ</th>
                <th>Status</th>
                <th>Role</th>
                <th>Panel</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                @forelse($users as $user)
                    <td>{{ $user->full_name() }}</td>
                    <td>
                        <a href="{{ route('meet.index', [$user->id, $user->slug]) }}">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td><span class="badge badge-secondary">Aktívny</span><span class="badge badge-secondary">Poslať pozvánku</span></td>
                    <td>
                        @foreach($user->roles as $role)
                        <span class="badge badge-secondary">{{ $role->name }}</span>
                        @endforeach
                    </td>


                    {{--@can( 'update', $post)--}}
                    <td class="d-flex justify-content-center">
                        <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cog text-secondary"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{--                        <a class="dropdown-item" href="{{ route('zast.edit', [$council->id, $council->slug]) }}">--}}
                            {{--                            <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>--}}
                            {{--                            Upraviť položku--}}
                            {{--                        </a>--}}
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
                    {{--@endcan--}}
            </tr>
            @empty
                {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
            @endforelse

            </tbody>
        </table>
    </div>


@endsection
