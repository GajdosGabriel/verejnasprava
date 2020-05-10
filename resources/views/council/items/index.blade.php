@extends('layouts.app')
@section('page-title', 'Program zasadnutia')
@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')


<div class="col-md-12">
    <div class="row">
        <div class="col-md-9">
            <div class="col-12 mb-5">
                @can('delete')
                <a style="float: right" href="{{ route('item.create', [ $meeting->id, $meeting->slug ]) }}" class="btn btn-secondary">Nový návrh</a>
                @endcan
                <h2>Program schôdze</h2>
            </div>

            @forelse($items as $item)
                    <div class="mt-4 bg-white px-3 pt-3">
                        {{-- Published button--}}
                        @can('delete')

                            @can('delete')
                                <a class="nav-link p-0 pull-right" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog text-secondary"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('item.delete', [$item->id, $item->slug]) }}">
                                        <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i>
                                        Zmazať
                                    </a>
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

                            @endcan

                        <a href="{{ route('item.published', [ $item->id, $item->slug]) }}">
                            @if($item->published)
                                <span style="float: right" class="badge badge-primary">Publikované</span>
                            @else
                                <span style="float: right" class="badge badge-secondary">Publikovať</span>
                            @endif
                        </a>

                        {{-- Item Up button--}}
                        <a href="{{ route('item.up', [ $item->id, $item->slug]) }}">
                            <span style="float: right; margin-right: .2rem" class="badge badge-light" title="Hore"><i class="fa fa-caret-up"></i></span>
                        </a>

                        {{-- Item Down button--}}
                        <a href="{{ route('item.down', [ $item->id, $item->slug]) }}">
                            <span style="float: right; margin-right: .2rem" class="badge badge-light" title="Dole"><i class="fa fa-caret-down"></i></span>
                        </a>

                        @endcan

                        {{-- Hlasovanie  --}}
                        @if($item->vote_type)
                            <span style="float: right" class="badge badge-info">Tajné</span>
                        @endif

                        @if($item->vote_disabled)
{{--                            <span style="float: right" class="badge badge-secondary">Hlasovanie vypnuté</span>--}}
                        @else
                            <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}">
                                <span style="float: right" class="badge badge-success">Hlasovanie zapnuté</span>
                            </a>
                        @endif

                        <h5 style="border-bottom: 2px solid silver">
                            <a href="{{ route('item.show', [$item->id, $item->slug]) }}">
                                {{ $loop->iteration }}.  {{ $item->name }}
                            </a>
                        </h5>

                        <p>{!! strip_tags( $item->descriptionLimit(340) ) !!}</p>



                        {{-- Files --}}
                        @if( $item->files->count())

                            @forelse($item->files as $file)
                                <a class="mr-2" target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                            @empty
                                Bez prílohy
                            @endforelse
                        @endif
                    </div>

                    <div class=" bg-secondary text-white text-center">
                        Za: {{ $item->users()->where('vote', 1)->count() }}
                        Proti: {{ $item->users()->where('vote', 0)->count() }}
                        Nehlasoval: {{ $item->users()->where('vote', 2)->count() }}
                    </div>
            @empty
                bez záznamu
            @endforelse
        </div>

        <div class="col-md-3">

        </div>

    </div>

</div>




@endsection
