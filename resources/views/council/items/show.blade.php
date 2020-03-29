@extends('layouts.app')

@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')



<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <h2>Program: {{ $council->name }} zastupiteľstvo</h2>
            <div class="card mt-3">
                    <div class="card-header">
                        <span class="badge badge-primary">Hlasovanie verejné</span>
                        <span class="badge badge-light">Do rozpravy</span>
                    </div>
                    <div class="card-body">
                        <h5 style="border-bottom: 2px solid silver">{{ $item->name }}</h5>
                        <p class="card-text"> {!! $item->description !!}</p>

                        {{--File--}}
                        @if( $item->files->count())
                            <h5 class="mt-4" style="border-bottom: 2px solid silver">Príloha</h5>
                            @forelse($item->files as $file)
                                <a class="mr-2" target="_blank" href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}.Príloha</a>
                            @empty
                                Bez prílohy
                            @endforelse
                        @endif
                    </div>

                    {{-- Votes Buttons--}}
                    <form method="POST" action="{{ route('vote.store', [ $item->id, $item->slug]) }}">
                        @csrf @method('POST')
                        <div class="card-footer d-flex justify-content-between">
                            <button name="vote" value="1" class="btn btn-primary"
                            @if($item->vote_disabled) disabled @endif >Súhlasim</button>
                            <button name="vote" value="2" class="btn btn-light" @if($item->vote_disabled) disabled @endif>Zdržal</button>
                            <button name="vote" value="0" class="btn btn-danger pull-right" @if($item->vote_disabled) disabled @endif>Nesúhlasim</button>
                        </div>
                    </form>
                </div>
        </div>

        {{--Aside part--}}
        <div class="col-md-4">
            <div class="row">
                <div class="col-12 mb-4">
                    <h5 style="float: left">Výsledok hlasovania</h5>
                    {{--Vote Admin Button --}}
                    @if($item->vote_disabled)
                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-secondary pull-right btn-sm">Zapnúť hlasovanie</a>
                    @else
                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-success pull-right btn-sm">Hlasovanie zapnuté</a>
                    @endif
                </div>
                <div class="col-12">
                    <ul class="list-group">
                    @forelse($item->users as $user)

                        @if($user->pivot->vote == 1 )
                            <li class="list-group-item list-group-item-primary">  {{ $user->full_name() }}
                            <span class="pull-right"><strong>Áno</strong></span>
                            </li>
                        @endif

                        @if($user->pivot->vote == 0 )
                                <li class="list-group-item list-group-item-danger">  {{ $user->full_name() }}
                                    <span class="pull-right"><strong>Nie</strong></span>
                                </li>
                        @endif

                        @if($user->pivot->vote == 2 )
                                <li class="list-group-item list-group-item-secondary">  {{ $user->full_name() }}
                                    <span class="pull-right"><strong>Zdržal</strong></span>
                                </li>
                        @endif
                    @empty
                    @endforelse
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</div>




@endsection
