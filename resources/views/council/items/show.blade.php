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
                <div class="flex justify-between mt-3">
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

                <vote-form-button :item="{{ $item }}"></vote-form-button>

{{--                @if(! $item->vote_disabled)--}}
{{--                    <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>--}}
{{--                    <form method="POST" action="{{ route('vote.store', [ $item->id, $item->slug]) }}">--}}
{{--                        @csrf @method('POST')--}}
{{--                        <div--}}
{{--                            class="md:flex justify-between my-5 bg-gray-100 @if($item->vote_disabled) opacity-50 @endif">--}}
{{--                             Button YES--}}
{{--                            <button name="vote" value="1"--}}
{{--                                    class="btn btn-primary font-semibold flex items-center justify-center md:w-auto w-full my-3  @if($item->vote_disabled) cursor-not-allowed @endif"--}}
{{--                                    @if($item->vote_disabled) disabled @endif >--}}
{{--                                Súhlasim--}}

{{--                                @if($item->votes()->whereUserId(auth()->user()->id)->pluck('vote')->first() == 1)--}}
{{--                                    <svg class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         viewBox="0 0 20 20">--}}
{{--                                        <path--}}
{{--                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>--}}
{{--                                    </svg>--}}
{{--                                @endif--}}
{{--                            </button>--}}

{{--                             Button WAIT--}}
{{--                            <button name="vote" value="2"--}}
{{--                                    class="btn btn-secondary font-semibold flex items-center justify-center md:w-auto w-full my-3 @if($item->vote_disabled) cursor-not-allowed @endif"--}}
{{--                                    @if($item->vote_disabled) disabled @endif >--}}
{{--                                Zdržal--}}
{{--                                @if($item->votes()->whereUserId(auth()->user()->id)->pluck('vote')->first() == 2)--}}
{{--                                    <svg class="w-5 h-5 ml-2 text-blue-600 fill-current"--}}
{{--                                         xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         viewBox="0 0 20 20">--}}
{{--                                        <path--}}
{{--                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>--}}
{{--                                    </svg>--}}
{{--                                @endif--}}
{{--                            </button>--}}
{{--                             Button No--}}
{{--                            <button name="vote" value="0"--}}
{{--                                    class="btn btn-danger font-semibold  flex items-center justify-center md:w-auto w-full  my-3  @if($item->vote_disabled) cursor-not-allowed @endif"--}}
{{--                                    @if($item->vote_disabled) disabled @endif >--}}
{{--                                Nesúhlasim--}}
{{--                                @if($item->votes()->whereUserId(auth()->user()->id)->pluck('vote')->first() == 0)--}}
{{--                                    <svg class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                         viewBox="0 0 20 20">--}}
{{--                                        <path--}}
{{--                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>--}}
{{--                                    </svg>--}}
{{--                                @endif--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                @endif--}}

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

{{--            --}}{{--Vote Admin Button --}}
{{--            <div class="w-full mb-6 text-center">--}}
{{--                @can('delete')--}}
{{--                    @if($item->vote_disabled)--}}
{{--                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}"--}}
{{--                           class="text-xs btn btn-secondary">Zapnúť hlasovanie</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}"--}}
{{--                           class="text-xs btn btn-primary">Hlasovanie zapnuté</a>--}}
{{--                    @endif--}}
{{--                @endcan--}}
{{--            </div>--}}


            <vote-start-button :item="{{ $item }}"></vote-start-button>

            @if($item->votes()->count() > 0)
                {{-- Vote results Variant I. --}}
                <ul class="mb-10 border-2 border-gray-500 rounded-md shadow-md">
                    <li class="flex justify-between px-3 font-semibold text-gray-200 bg-gray-800 border-b-2"><span>Hlasovalo:</span>
                        <span>{{ $item->votes()->count() }}</span></li>
                    <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Za:</span>
                        <span>{{ $item->votes()->where('vote', 1)->count() }}</span></li>
                    <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted "><span>Proti:</span>
                        <span>{{ $item->votes()->where('vote', 0)->count() }}</span></li>
                    <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted "><span>Zdržal:</span>
                        <span>{{ $item->votes()->where('vote', 2)->count() }}</span></li>
                </ul>




                {{-- Výsledky hlasovania--}}
                <div class="">
                    <h2 class="my-5 text-lg font-semibold">Výsledky hlasovania</h2>
                    <ul class="">
                        @forelse($item->votes as $vote)

                            {{-- Hlas Za --}}
                            @if($vote->vote == 1 )
                                <li class="flex justify-between border-b-2 border-dotted">
                                    @if($vote->item->vote_type == 1)
                                        Hlas
                                        <span class="font-semibold">Za</span>
                                    @else
                                        {{ $vote->user->full_name() }}
                                        <span class="font-semibold">Áno</span>
                                    @endif
                                </li>
                            @endif
                            {{-- Hlas Proti --}}
                            @if($vote->vote == 0 )
                                <li class="flex justify-between border-b-2 border-dotted">
                                    @if($vote->item->vote_type == 1)
                                        Hlas
                                        <span class="font-semibold">Nie</span>
                                    @else
                                        {{ $vote->user->full_name() }}
                                        <span class="font-semibold">Nie</span>
                                    @endif
                                </li>
                            @endif

                            {{-- Zdržal sa --}}
                            @if($vote->vote == 2 )
                                <li class="flex justify-between border-b-2 border-dotted">
                                    @if($vote->item->vote_type == 1)
                                        Hlas
                                        <span class="font-semibold">Zdržal</span>
                                    @else
                                        {{ $vote->user->full_name() }}
                                        <span class="font-semibold">Zdržal</span>
                                    @endif
                                </li>
                            @endif
                        @empty
                        @endforelse
                    </ul>
                </div>
            @endif





            <interpelation-table :item="{{ $item }}"/>


            {{-- Users Interpellations--}}
{{--                        @include('council.items.interpellation.aside-list')--}}
{{----}}
        </div>
    </div>





@endsection
