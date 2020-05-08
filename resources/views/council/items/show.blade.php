@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')
@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')



<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            <h2>Program: {{ $meeting->name }} zastupiteľstvo</h2>
            <div class="card mt-3">
                    <div class="card-header">
                        <span class="badge badge-primary">Hlasovanie verejné</span>
                        <span class="badge badge-light">Do rozpravy</span>
                        @can('delete')
                        <a href="{{ route('item.edit', [ $item->id, $item->slug]) }}">
                            <span class="badge badge-light pull-right">Upraviť</span>
                        </a>
                        @endcan
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
                    @can('delete')
                        {{--Vote Admin Button --}}
                        @if($item->vote_disabled)
                            <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-secondary pull-right btn-sm">Zapnúť hlasovanie</a>
                        @else
                            <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-success pull-right btn-sm">Hlasovanie zapnuté</a>
                        @endif
                    @endcan
                </div>
                <div class="col-12">
                    <ul class="list-group">
                    @forelse($item->users as $user)

                        {{-- Hlas Za --}}
                        @if($user->pivot->vote == 1 )
                            <li class="list-group-item list-group-item-primary">
                                @if($item->vote_type == 1)
                                    Hlas
                                    <span class="pull-right"><strong>Za</strong></span>
                                @else
                                    {{ $user->full_name() }}
                                    <span class="pull-right"><strong>Áno</strong></span>
                                 @endif
                            </li>
                        @endif
                            {{-- Hlas Proti --}}
                        @if($user->pivot->vote == 0 )
                                <li class="list-group-item list-group-item-danger">
                                    @if($item->vote_type == 0)
                                        {{ $user->full_name() }}
                                        <span class="pull-right"><strong>Nie</strong></span>
                                    @else
                                        Hlas
                                        <span class="pull-right"><strong>Proti</strong></span>
                                    @endif
                                </li>
                        @endif

                        {{-- Zdržal sa --}}
                        @if($user->pivot->vote == 2 )
                                <li class="list-group-item list-group-item-secondary">
                                    @if($item->vote_type == 2)
                                        Hlas
                                        <span class="pull-right"><strong>Zdržal</strong></span>
                                    @else
                                        {{ $user->full_name() }}
                                        <span class="pull-right"><strong>Zdržal</strong></span>
                                    @endif
                                </li>
                        @endif
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Vote results Variant I. --}}
            <ul class="list-group">
                <li class="list-group-item active">Hlasovalo:  {{ $item->users()->count() }}</li>
                <li class="list-group-item">Za: <strong class="text-right">{{ $item->users()->where('vote', 1)->count() }}</strong></li>
                <li class="list-group-item">Proti: <strong>{{ $item->users()->where('vote', 0)->count() }}</strong></li>
                <li class="list-group-item">Zdržal: <strong>{{ $item->users()->where('vote', 2)->count() }}</strong></li>
            </ul>

            {{-- Vote results Variant II. --}}
            <dl class="row mt-4">

                <dt class="col-sm-3">Za:</dt>
                <dd class="col-sm-9"><strong class="text-right">{{ $item->users()->where('vote', 1)->count() }}</strong></dd>

                <dt class="col-sm-3">Proti:</dt>
                <dd class="col-sm-9"><strong class="text-right">{{ $item->users()->where('vote', 0)->count() }}</strong></dd>

                <dt class="col-sm-3">Zdržal:</dt>
                <dd class="col-sm-9"><strong class="text-right">{{ $item->users()->where('vote', 2)->count() }}</strong></dd>

                <dt class="col-sm-3">Hlasovalo:</dt>
                <dd class="col-sm-9"><strong class="text-right">{{ $item->users()->count() }}</strong></dd>

            </dl>

        </div>
    </div>
</div>






@endsection
