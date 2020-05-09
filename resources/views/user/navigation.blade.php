
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ route('user.home', [auth()->user()->id, auth()->user()->slug])  }}">
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
{{--                    <a class="nav-link" href="{{ route('user.edit', [$user->id, $user->slug]) }}"> Upraviť užívateľa</a>--}}
{{--                </li>--}}

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.edit', [auth()->user()->id, auth()->user()->slug]) }}">Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('org.index', [auth()->user()->id, auth()->user()->slug]) }}">Späť</a>


                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

