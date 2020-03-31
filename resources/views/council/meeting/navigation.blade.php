
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('meet.index', [$council->id, $council->slug])  }}">
                {{ $organizationNav->name }} - {{ $council->name }}
            </a>
        </div>

        {{--collapse --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('org.post.index', [$organizationNav->id, $organizationNav->slug ]) }}">Zverejňovanie</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('org.contact.index', [$organizationNav->id, $organizationNav->slug ]) }}">Kontakty</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link" href="{{ route('order.index', [$organizationNav->id, $organizationNav->slug]) }}">Objednávky</a></li>--}}


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->full_name() }}
                </a>
                <div class="dropdown-menu">
{{--                    <a class="dropdown-item" href="{{ route('org.edit', [$organizationNav->id, $organizationNav->slug]) }}">Upraviť profil</a>--}}
{{--                    <a class="dropdown-item" href="{{ route('zast.index', [auth()->user()->id, auth()->user()->slug ]) }}">Zamestnanci</a>--}}

                    @role('superadmin')
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url( 'admin/user') }}">Zoznam regist.</a>
                    @endrole

                    <a class="dropdown-item" href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Odhlásiť
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                     @csrf
                    </form>
                </div>
            </li>
        </ul>
        </div>
    </div>
</nav>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

