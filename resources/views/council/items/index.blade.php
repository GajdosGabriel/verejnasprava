@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


@section('navigation')
    <x-navigation.navigationItems/> @endsection

{{--@section('navigation')--}}
{{--    @include('council.items.navigation')--}}
{{--@endsection--}}

@section('content')

    <div class="lg:container lg:flex mx-auto lg:px-6 min-h-screen py-6">

        <div class="lg:w-3/4 px-4 md:px-6  mb-6">
            <div class="mb-6">
                <h1 class="page-title">{{ $meeting->name }} <small
                        class="text-gray-500">{{ $meeting->start_at->format('d. m. Y') }}
                        <strong>{{ $meeting->start_at->format('H:i') }} hod.</strong></small></h1>
                {{--                @can('delete')--}}
                {{--                    <a href="{{ route('item.create', [ $meeting->id, $meeting->slug ]) }}"--}}
                {{--                       class="btn btn-primary text-center text-sm flex items-center">Nový návrh</a>--}}
                {{--                @endcan--}}
            </div>

            @forelse($items as $item)
                <div class="mt-4 bg-white hover:bg-gray-100 p-2 odd:bg-gray-500">
                    <div class="flex justify-between flex-wrap mt-2 mb-5">

                        <h5 class="font-semibold mb-4">
                            <a href="{{ route('item.show', [$item->id, $item->slug]) }}">
                                {{ $loop->iteration }}. {{ $item->name }}
                            </a>
                        </h5>


                        <div class="flex flex-wrap items-center space-x-3">


                            {{-- Users Interpellations--}}
                            @include('council.items.interpellation.button')


                            {{-- Hlasovanie  --}}
                            @if($item->vote_type)
                                <span class="badge badge-danger" title="Hlasovanie tajné">Tajné</span>
                            @endif

                            @if($item->vote_disabled)
                                {{--                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}">--}}
                                <span class="badge badge-secondary" title="Hlasovanie vypnuté">Hlasovanie</span>
                                {{--                                </a>--}}
                            @else
                                {{--                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}">--}}
                                <span class="badge badge-primary " title="Hlasovanie zapnuté">Hlasovanie</span>
                                {{--                                </a>--}}
                            @endif




                            @can('delete')
                                {{-- Published button--}}
                                <a href="{{ route('item.published', [ $item->id, $item->slug]) }}">
                                    @if($item->published)
                                        <span class="badge badge-primary">Publikované</span>
                                    @else
                                        <span class="badge badge-secondary">Publikovať</span>
                                    @endif
                                </a>

                                {{-- Dropdown component  --}}
                                @auth
                                    <nav-horizontal inline-template>
                                        <div class="relative flex items-start">
                                            <a @click="isOpen =! isOpen" class="" href="#">
                                                <svg
                                                    class="w-4 h-4 ml-2 fill-current text-gray-500 hover:text-green-800"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                                </svg>
                                            </a>

                                            <div v-if="isOpen"
                                                 class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                                                {{-- Item Up button--}}
                                                <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                                                   href="{{ route('item.up', [ $item->id, $item->slug]) }}"
                                                   title="Presunúť položku smerom hore">
                                                    Presúnúť hore
                                                </a>

                                                {{-- Item Down button--}}
                                                <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                                                   href="{{ route('item.down', [ $item->id, $item->slug]) }}"
                                                   title="Presunúť položku smerom dole">
                                                    Presúnúť dole
                                                </a>

                                                {{-- Item Down button--}}
                                                <a class="hover:bg-gray-200 px-4 py-1 whitespace-no-wrap"
                                                   href="{{ route('item.edit', [ $item->id, $item->slug]) }}"
                                                   title="Presunúť položku smerom dole">
                                                    Upraviť
                                                </a>

                                                <div class="py-1"></div>

                                                <a class="hover:bg-gray-200 px-4"
                                                   href="{{ route('item.delete', [$item->id, $item->slug]) }}">
                                                    <i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip"
                                                       data-placement="left" title="Upraviť položku"></i>
                                                    Zmazať
                                                </a>
                                            </div>

                                        </div>
                                    </nav-horizontal>
                                @endauth
                                {{-- End Dropdown component  --}}

                                {{-- Item Up button--}}
                                {{--                                <a href="{{ route('item.up', [ $item->id, $item->slug]) }}">--}}
                                {{--                                    <span style="float: right; margin-right: .2rem" class="badge badge-light" title="Hore"><i class="fa fa-caret-up"></i></span>--}}
                                {{--                                </a>--}}

                                {{-- Item Down button--}}
                                {{--                                <a href="{{ route('item.down', [ $item->id, $item->slug]) }}">--}}
                                {{--                                    <span style="float: right; margin-right: .2rem" class="badge badge-light" title="Dole"><i class="fa fa-caret-down"></i></span>--}}
                                {{--                                </a>--}}



                            @endcan

                        </div>

                    </div>
                    <vote-start-button :itemid="{{ $item->id }}"></vote-start-button>
                    {{-- Votes Buttons--}}
                    <vote-form-button :itemid="{{ $item->id }}"></vote-form-button>

                    {{--  <p>{!! strip_tags( $item->descriptionLimit(340) ) !!}</p>--}}


                    {{-- Files --}}
                    @if( $item->files->count())

                        @forelse($item->files as $file)
                            <a class="mr-2" target="_blank"
                               href="{{ route('file.show', [$file->id, $file->filename]) }}">{{ $loop->iteration }}
                                .Príloha
                            </a>
                        @empty
                            Bez prílohy
                        @endforelse
                    @endif

                    @if($item->votes()->count())
                        <div class="flex justify-between">
                            <span>Za: {{ $item->votes()->where('vote', 1)->count() }}</span>
                            <span>Nehlasoval: {{ $item->votes()->where('vote', 2)->count() }}</span>
                            <span>Proti: {{ $item->votes()->where('vote', 0)->count() }}</span>
                        </div>
                    @endif
                </div>

            @empty
                bez záznamu
            @endforelse
        </div>

        {{-- ASIDE --}}
        <div class="lg:w-1/4 md:px-6 px-4">
            <livewire:comments :meeting="$meeting"/>
        </div>

    </div>




@endsection
