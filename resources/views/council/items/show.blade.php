@extends('layouts.app')
@section('page-title', 'Zobraziť návrh')

{{--@section('navigation') <x-navigationItems /> @endsection--}}

@section('navigation') @include('council.items.navigation') @endsection

@section('content')



    <div class="container min-h-screen p-3 mx-auto sm:flex">
        <div class="md:w-3/4 xs:w-full">
            <div class="">
                {{-- Title --}}
                <h1 class="text-lg page-title">Rokovací bod: {{ $item->name }} zastupiteľstvo</h1>

                {{-- Badge line --}}
                <div class="flex justify-between mt-3 ">
                    <div class="flex flex-wrap items-center space-x-3">
                        {{-- Users Interpellations--}}
                        @include('council.items.interpellation.button')

                        <div class="badge badge-primary">Hlasovanie verejné</div>

                    </div>

                    @can('delete')
                        <nav-horizontal inline-template>
                            <div class="relative flex items-center">
                                <a @click="isOpen =! isOpen"
                                   class="flex items-center justify-center w-6 h-6 bg-gray-500 rounded-md opacity-50"
                                   href="#">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                    </svg>
                                </a>

                                <div v-if="isOpen"
                                     class="absolute z-10 flex flex-col w-32 py-1 text-sm bg-white border-2 border-gray-300 rounded shadow-md">
                                    {{-- Item Up button--}}
                                    <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200"
                                       href="{{ route('item.edit', [$item->id, $item->slug]) }}"
                                       title="Upraviť položku">
                                        Upraviť položku
                                    </a>
                                </div>
                            </div>
                        </nav-horizontal>
                    @endcan
                </div>

                {{-- Votes Buttons--}}
                @if(! $item->vote_disabled)
                    <form method="POST" action="{{ route('vote.store', [ $item->id, $item->slug]) }}">
                        @csrf @method('POST')
                        <div
                            class="flex justify-between my-5 bg-gray-100 py-2 @if($item->vote_disabled) opacity-50 @endif">
                            <button name="vote" value="1"
                                    class="btn btn-primary font-semibold      @if($item->vote_disabled) cursor-not-allowed @endif"
                                    @if($item->vote_disabled) disabled @endif >Súhlasim
                            </button>
                            <button name="vote" value="2"
                                    class="btn btn-secondary font-semibold    @if($item->vote_disabled) cursor-not-allowed @endif"
                                    @if($item->vote_disabled) disabled @endif >Zdržal
                            </button>
                            <button name="vote" value="0"
                                    class="btn btn-danger font-semibold       @if($item->vote_disabled) cursor-not-allowed @endif"
                                    @if($item->vote_disabled) disabled @endif >Nesúhlasim
                            </button>
                        </div>
                    </form>
                @endif

                {{-- Body text--}}
                <div class="py-3">

                    <p> {!! $item->description !!}</p>

                    {{--File--}}
                    @if( $item->files->count())
                        <h5 class="mt-4" style="border-bottom: 2px solid silver">Príloha</h5>
                        @forelse($item->files as $file)
                            <a class="mr-2" target="_blank"
                               href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}
                                .Príloha</a>
                        @empty
                            Bez prílohy
                        @endforelse
                    @endif
                </div>
            </div>
        </div>

        {{--Aside part--}}
        <div class="p-3 md:w-1/4 xs:w-full">

            {{--Vote Admin Button --}}
            <div class="w-full mb-6 text-center">
                @can('delete')
                    @if($item->vote_disabled)
                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}"
                           class="text-xs btn btn-secondary">Zapnúť hlasovanie</a>
                    @else
                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}"
                           class="text-xs btn btn-primary">Hlasovanie zapnuté</a>
                    @endif
                @endcan
            </div>

            <div class="">
                <h2 class="my-5 font-semibold">Výsledok hlasovania</h2>
                <ul class="">
                    @forelse($item->votes as $vote)

                        {{-- Hlas Za --}}
                        @if($vote->vote == 1 )
                            <li class="list-group-item list-group-item-primary">
                                @if($vote == 1)
                                    Hlas
                                    <span class="pull-right"><strong>Za</strong></span>
                                @else
                                    {{ $vote->user->full_name() }}
                                    <span class="pull-right"><strong>Áno</strong></span>
                                @endif
                            </li>
                        @endif
                        {{-- Hlas Proti --}}
                        @if($vote->vote == 0 )
                            <li class="list-group-item list-group-item-danger">
                                @if($vote == 1)
                                    Hlas
                                    <span class="pull-right"><strong>Nie</strong></span>
                                @else
                                    {{ $vote->user->full_name() }}
                                    <span class="pull-right"><strong>Proti</strong></span>
                                @endif
                            </li>
                        @endif

                        {{-- Zdržal sa --}}
                        @if($vote->vote == 2 )
                            <li class="list-group-item list-group-item-secondary">
                                @if($vote == 1)
                                    Hlas
                                    <span class="pull-right"><strong>Zdržal</strong></span>
                                @else
                                    {{ $vote->user->full_name() }}
                                    <span class="pull-right"><strong>Zdržal</strong></span>
                                @endif
                            </li>
                        @endif
                    @empty
                    @endforelse
                </ul>
            </div>

            @if($item->votes()->count() > 0)
                {{-- Vote results Variant I. --}}
                <ul class="mb-10">
                    <li class="flex justify-between font-semibold border-b-2 border-dotted"><span>Hlasovalo:</span>
                        <span>{{ $item->votes()->count() }}</span></li>
                    <li class="flex justify-between font-semibold border-b-2 border-dotted"><span>Za:</span>
                        <span>{{ $item->votes()->where('vote', 1)->count() }}</span></li>
                    <li class="flex justify-between font-semibold border-b-2 border-dotted"><span>Proti:</span>
                        <span>{{ $item->votes()->where('vote', 0)->count() }}</span></li>
                    <li class="flex justify-between font-semibold border-b-2 border-dotted"><span>Zdržal:</span>
                        <span>{{ $item->votes()->where('vote', 2)->count() }}</span></li>
                </ul>
            @endif

            {{-- Users Interpellations--}}
            @include('council.items.interpellation.aside-list')


        </div>
    </div>





@endsection
