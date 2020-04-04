@extends('layouts.app')

@section('navigation')
    @include('council.meeting.navigation')
@endsection

@section('content')


<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="col-12 mb-5">
                <a style="float: right" href="{{ route('item.create', [ $council->id, $council->slug ]) }}" class="btn btn-secondary">Nový návrh</a>
                <h2>Program schôdze</h2>
            </div>

            <ol type="1">
            @forelse($council->items as $item)
                    <li>
                        {{-- Published button--}}
                        <a href="{{ route('item.published', [ $item->id, $item->slug]) }}">
                            @if($item->published)
                                <span style="float: right" class="badge badge-primary">Publikované</span>
                            @else
                                <span style="float: right" class="badge badge-secondary">Publikovať</span>
                            @endif

                            @if($item->vote_type == 2)
                                    <span style="float: right" class="badge badge-info">Publikované</span>
                            @else
                            @endif
                        </a>

                        @if($item->vote_disabled)
{{--                            <span style="float: right" class="badge badge-secondary">Hlasovanie vypnuté</span>--}}
                        @else
                            <span style="float: right" class="badge badge-success">Hlasovanie zapnuté</span>
                        @endif

                        <h5 style="border-bottom: 2px solid silver">
                            <a href="{{ route('item.show', [$item->id, $item->slug]) }}">
                                {{ $item->name }}
                            </a>
                        </h5>

                        <p>{!! $item->descriptionLimit(320) !!}</p>

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
