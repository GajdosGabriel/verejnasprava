@extends('layouts.app')
@section('page-title', 'Program zasadnutia')
@section('navigation')
    @include('council.meeting.navigation')
@endsection

@section('content')


<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="col-12 mb-5">
                @can('delete')
                <a style="float: right" href="{{ route('item.create', [ $council->id, $council->slug ]) }}" class="btn btn-secondary">Nový návrh</a>
                @endcan
                <h2>Program schôdze</h2>
            </div>

            <ol type="1">
            @forelse($council->items as $item)
                    <li class="mt-4 bg-white px-3 pt-3">
                        {{-- Published button--}}
                        @can('delete')
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
                                {{ $item->name }}
                            </a>
                        </h5>

                        <p>{!! strip_tags( $item->descriptionLimit(340) ) !!}</p>

                        <div class=" bg-light text-dark text-center">
                            Za: {{ $item->users()->where('vote', 1)->count() }}
                            Proti: {{ $item->users()->where('vote', 0)->count() }}
                            Nehlasoval: {{ $item->users()->where('vote', 2)->count() }}
                        </div>

                        {{-- Files --}}
                        @if( $item->files->count())

                            @forelse($item->files as $file)
                                <a class="mr-2" target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                            @empty
                                Bez prílohy
                            @endforelse
                        @endif
                    </li>
            @empty
                bez záznamu
            @endforelse
            </ol>
        </div>

        <div class="col-md-4">

        </div>

    </div>

</div>




@endsection
