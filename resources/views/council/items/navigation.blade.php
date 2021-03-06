<nav-drop-down inline-template>
    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-3">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/>
            </svg>
            <span class="font-semibold text-xl tracking-tight">
                @forelse($item->meetings as $meeting)
                    <a href="{{ route('meetings.show', $meeting->id) }}">
            {{ $meeting->name }}
            </a>
                @empty
                @endforelse
        </span>
        </div>
        <div class="block lg:hidden">
            <button @click="isOpen =! isOpen"
                    class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                        Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                {{--  // --}}
            </div>

            <div class="">

                {{-- Header Menu Horizontal --}}
                @forelse($organization->menus as $menu)
                    @continue($menu->type == 'vertical')
                    <a :class="isOpen ? 'block' : 'hidden'"
                       class="text-teal-200 block mt-4 lg:inline-block lg:mt-0 hover:text-white mr-4"
                       @if(\Route::currentRouteName() == $menu['route'])
                       class="font-semibold text-white underline"
                       @endif
                       href="{{ route($menu['route']) }}">{{$menu['name']}}</a>
                @empty
                @endforelse


                <button v-if="signedIn" @click="dropdown =! dropdown" :class="isOpen ? 'block' : 'hidden'"
                        class=" mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4 focus:outline-none">
                    <div class="flex items-center">
                        @{{ fullName }}
                        {{--                            {{ auth()->user()->full_name() }}--}}
                        <span class="ml-2"> <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
                                                    transition duration-150 ease-in-out"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                      </svg></span>
                    </div>


                    {{-- Dropdown component  --}}
                    <ul v-show="dropdown" class="dropdown-menu absolute text-gray-700 pt-1 my-2" style="z-index: 99">
                        {{-- Header Menu Vertical --}}
                        @forelse($organization->menus as $menu)
                            @continue($menu->type == 'horizontal')
                            <li>
                                <a class="rounded bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap text-left"
                                   href="{{ route($menu['route']) }}">{{$menu['name']}}</a>
                            </li>
                        @empty
                        @endforelse

                        <li>@include('user._logout')</li>
                    </ul>
                    {{-- End Dropdown component  --}}
                </button>
            </div>

        </div>
    </nav>
</nav-drop-down>
