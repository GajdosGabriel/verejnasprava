@extends('layouts.app')

@section('navigation')
    @include('council.meeting.navigation')
@endsection

@section('content')


    <h2>Zoznam zasadnutí</h2>
    <div class="col-md-12">
        <a class="btn btn-primary float-right" href="{{ route('meet.create', [auth()->user()->id, auth()->user()->slug ]) }}">Nové zasadnutie</a>

        <table class="table table-bordered table-inverse table-hover">
            <thead>
                <tr class="alert-info">
                    <th>Dátum</th>
                    <th>Popis</th>
                    <th>Typ</th>
                    <th>Vystavil</th>
                    <th>Príloha</th>
                    <th>Body rokovania</th>
                    <th>Panel</th>
                </tr>
            </thead>
            <tbody>
            <tr>


                @forelse($council->meetings as $council)
                    <td>{{ $council->start_at }}</td>
                    <td>
                        <a href="{{ route('meet.show', [$council->id, $council->slug]) }}">
                            {{ $council->name }}
                        </a>
                    </td>
                    <td>{{ $council->description }}</td>
                    <td>{{ $council->user->full_name() }}</td>
                    <td>
                        @forelse($council->files as $file)
                            <a target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                        @empty
                            Bez prílohy
                        @endforelse
                    </td>
                    <td>{{ $council->items()->count() }}</td>

                {{--@can( 'update', $post)--}}
                <td class="d-flex justify-content-center">
                    <a class="nav-link p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog text-secondary"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('meet.edit', [$council->id, $council->slug]) }}">
                            <i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                            Upraviť položku
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
                {{--@endcan--}}
            </tr>
            @empty
                {{--<tbody><tr><td>Žiadne doklady</td></tr></tbody>--}}
            @endforelse

            </tbody>
        </table>
    </div>



@endsection
