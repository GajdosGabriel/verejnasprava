
<nav-items inline-template>

    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-3">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
            <span class="font-semibold text-xl tracking-tight">
            <a  href="{{ route('item.index', [$meeting->id, $meeting->slug])  }}">
            {{ $meeting->name }}
            </a>
        </span>
        </div>
        <div class="block lg:hidden">
            <button @click="isOpen =! isOpen" class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
{{--                <ul class="navbar-nav ml-auto">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{ route('item.create', [ $meeting->id, $meeting->slug ]) }}">Objednávky</a></li>--}}
{{--                </ul>--}}
            </div>

            <div class="">

                <a :class="isOpen ? 'block' : 'hidden'"
                   class="block mt-4 lg:inline-block lg:mt-0 hover:text-white mr-4 "
                   href="{{route('item.create', [ $meeting->id, $meeting->slug ])}}">
                    Nový bod
                </a>



            @if(isset($headerMenu))
                    @foreach($headerMenu as $link)
                        <a :class="isOpen ? 'block' : 'hidden'" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" href="{{$link['url']}}">{{$link['title']}}</a>
                    @endforeach
                @endif


                    <a @click="dropdown =! dropdown" :class="isOpen ? 'block' : 'hidden'" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" href="#">
                        <div class="flex items-center">
                            {{ auth()->user()->full_name() }}
                            <span class="ml-2"> <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180
                        transition duration-150 ease-in-out"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                      </svg></span>
                        </div>
                    </a>

                    {{-- Dropdown component  --}}

                    <ul v-show="dropdown"  class="dropdown-menu absolute text-gray-700 pt-1 right-0">
                        @if(isset($dropDownItems))
                            @foreach($dropDownItems as $item)
                                <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="{{$item['url']}}">{{$item['title']}}</a></li>
                            @endforeach
                        @endif
                    </ul>

                {{-- End Dropdown component  --}}

            </div>


        </div>
    </nav>










{{--    --}}
{{--    <div class="container">--}}

{{--        <div class="navbar-header">--}}
{{--            <a class="navbar-brand" href="{{ route('item.index', [$meeting->id, $meeting->slug])  }}">--}}
{{--                {{ $meeting->name }}--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        --}}{{--collapse --}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}

{{--        <!-- Right Side Of Navbar -->--}}
{{--        <ul class="navbar-nav ml-auto">--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('org.post.index', [$organizationNav->id, $organizationNav->slug ]) }}">Zverejňovanie</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('org.contact.index', [$organizationNav->id, $organizationNav->slug ]) }}">Kontakty</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('order.index', [$organizationNav->id, $organizationNav->slug]) }}">Objednávky</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('zast.index', [auth()->user()->id, auth()->user()->slug ]) }}">Zastupiteľstva</a></li>--}}


{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    {{ auth()->user()->full_name() }}--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu">--}}
{{--                    <a class="dropdown-item" href="{{ route('org.index', [$object->id, $object->slug]) }}">Hlavna strana</a>--}}
{{--                    <a class="dropdown-item" href="{{ route('org.edit', [$organizationNav->id, $organizationNav->slug]) }}">Upraviť profil</a>--}}
{{--                    <a class="dropdown-item" href="{{ route('zast.index', [auth()->user()->id, auth()->user()->slug ]) }}">Zamestnanci</a>--}}

{{--                    @role('superadmin')--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="{{ url( 'admin/user') }}">Zoznam regist.</a>--}}
{{--                    @endrole--}}

{{--                    <a class="dropdown-item" href="{{ url('/logout') }}"--}}
{{--                       onclick="event.preventDefault();--}}
{{--                       document.getElementById('logout-form').submit();">--}}
{{--                        Odhlásiť--}}
{{--                    </a>--}}
{{--                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
{{--                     @csrf--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
</nav-items>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

