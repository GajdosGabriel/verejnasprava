@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')

@section('navigation') <x-navigationItems /> @endsection
{{--@section('navigation')--}}
{{--    @include('council.items.navigation')--}}
{{--@endsection--}}

@section('content')



    <div class="container mx-auto p-6 min-h-screen">
        <div class="md:flex">

            <div class="w-3/4 md:p-6">
                <h1 class="font-bold text-2xl">Program: {{ $meeting->name }} zastupiteľstvo</h1>
                <div class="card mt-3">
                    <div class="flex justify-between">
                        <h1 class="font-bold text-lg">{{ $item->name }}</h1>

                        <div>
                            <span class="badge badge-primary">Hlasovanie verejné</span>
                            <span class="badge badge-light">Do rozpravy</span>


                        </div>

                        @can('delete')
                            <nav-horizontal inline-template>
                                <div class="relative flex items-start">
                                    <a @click="isOpen =! isOpen" class="" href="#" >
                                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                                    </a>

                                    <div v-if="isOpen" class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">
                                        {{-- Item Up button--}}
                                        <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap" href="{{ route('item.edit', [$item->id, $item->slug]) }}" title="Upraviť položku">
                                            Upraviť položku
                                        </a>
                                    </div>
                                </div>
                            </nav-horizontal>
                        @endcan

                    </div>

                    <div class="card-body">

                        <p> {!! $item->description !!}</p>

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
                        <div class="flex justify-between my-5 bg-gray-100 py-2 @if($item->vote_disabled) opacity-50 @endif">
                            <button name="vote" value="1" class="btn btn-primary font-semibold      @if($item->vote_disabled) cursor-not-allowed @endif" @if($item->vote_disabled) disabled @endif >Súhlasim</button>
                            <button name="vote" value="2" class="btn btn-secondary font-semibold    @if($item->vote_disabled) cursor-not-allowed @endif" @if($item->vote_disabled) disabled @endif >Zdržal</button>
                            <button name="vote" value="0" class="btn btn-danger font-semibold @if($item->vote_disabled) cursor-not-allowed @endif" @if($item->vote_disabled) disabled @endif >Nesúhlasim</button>
                        </div>
                    </form>
                </div>
            </div>


            {{--Aside part--}}
            <div class="w-1/4 md:p-6">
                <div class="row">
                    <div class="col-12 mb-4">
                        @can('delete')
                            {{--Vote Admin Button --}}
                            @if($item->vote_disabled)
                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-secondary text-xs">Zapnúť hlasovanie</a>
                            @else
                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}" class="btn btn-primary text-xs">Hlasovanie zapnuté</a>
                            @endif
                        @endcan
                        <h2 class="font-semibold my-5">Výsledok hlasovania</h2>

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
                <ul class="mb-10">
                    <li class="font-semibold flex justify-between border-b-2 border-dotted"><span>Hlasovalo:</span>  <span>{{ $item->users()->count() }}</span></li>
                    <li class="font-semibold flex justify-between border-b-2 border-dotted"><span>Za:</span> <span>{{ $item->users()->where('vote', 1)->count() }}</span></li>
                    <li class="font-semibold flex justify-between border-b-2 border-dotted"><span>Proti:</span> <span>{{ $item->users()->where('vote', 0)->count() }}</span></li>
                    <li class="font-semibold flex justify-between border-b-2 border-dotted"><span>Zdržal:</span> <span>{{ $item->users()->where('vote', 2)->count() }}</span></li>
                </ul>

            </div>
        </div>
    </div>





@endsection
