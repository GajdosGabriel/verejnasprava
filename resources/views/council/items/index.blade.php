@extends('layouts.app')
@section('page-title', 'Program zasadnutia')

@section('navigation') <x-navigationItems /> @endsection

@section('navigation')
    @include('council.items.navigation')
@endsection

@section('content')


<div class="lg:container lg:flex mx-auto lg:px-6 py-6">

     <div class="lg:w-2/3 px-4 md:px-6  mb-6">
            <div class="flex justify-between">
                <h1 class="font-bold md:text-2xl text-l ">Program schôdze</h1>
                @can('delete')
                <a href="{{ route('item.create', [ $meeting->id, $meeting->slug ]) }}" class="btn btn-blue text-center text-sm">Nový návrh</a>
                @endcan
            </div>

            @forelse($items as $item)
                    <div class="mt-4 bg-white">

                        <div class="flex justify-between">

                        <h5 class="font-bold">
                            <a href="{{ route('item.show', [$item->id, $item->slug]) }}">
                                {{ $loop->iteration }}.  {{ $item->name }}
                            </a>
                        </h5>


                        <div class="flex">

                            {{-- Hlasovanie  --}}
                            @if($item->vote_type)
                                <span class="badge badge-danger" title="Hlasovanie tajné">Tajné</span>
                            @endif

                            @if($item->vote_disabled)
                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}">
                                <span class="badge badge-secondary" title="Hlasovanie vypnuté">Hlasovanie</span>
                                </a>
                            @else
                                <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}">
                                    <span class="badge badge-primary " title="Hlasovanie zapnuté">Hlasovanie</span>
                                </a>
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
                                    <dropdown inline-template>
                                       <div class="relative flex items-center">
                                           <a @click="isOpen =! isOpen" class="" href="#" >
                                               <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                                           </a>

                                           <div v-if="isOpen" class="absolute w-32 z-10 py-1 flex flex-col border-2 border-gray-300 shadow-md rounded text-sm bg-white">

                                               {{-- Item Up button--}}
                                               <a class="hover:bg-gray-200 px-4 py-1" href="{{ route('item.up', [ $item->id, $item->slug]) }}" title="Presunúť položku smerom hore">
                                                   Presúnúť hore
                                               </a>

                                               {{-- Item Down button--}}
                                               <a class="hover:bg-gray-200 px-4 py-1" href="{{ route('item.down', [ $item->id, $item->slug]) }}" title="Presunúť položku smerom dole">
                                                   Presúnúť dole
                                               </a>

                                               <div class="py-1"></div>

                                               <a class="hover:bg-gray-200 px-4" href="{{ route('item.delete', [$item->id, $item->slug]) }}">
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

                                       </div>
                                    </dropdown>
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

                    <div class="">
                        Za: {{ $item->users()->where('vote', 1)->count() }}
                        Proti: {{ $item->users()->where('vote', 0)->count() }}
                        Nehlasoval: {{ $item->users()->where('vote', 2)->count() }}
                    </div>
            @empty
                bez záznamu
            @endforelse
        </div>

    {{-- ASIDE --}}
    <div class="lg:w-1/3 md:px-6 px-4">
        <livewire:comments :meeting="$meeting" />
    </div>

</div>




@endsection
