
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ route('user.index', [auth()->user()->id, auth()->user()->slug])  }}">
            {{ auth()->user()->full_name() }}
        </a>

        {{--collapse --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('user.new-organization', [Auth::user()->id, Auth::user()->slug]) }}">Založiť organizáciu</a>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('org.new.user', [Auth::user()->id, Auth::user()->slug]) }}">Nový zamestnanec</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.new-organization', [Auth::user()->id, Auth::user()->slug]) }}">Založiť organizáciu</a>
                        <div class="dropdown-divider"></div>

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

