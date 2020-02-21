
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">
            <!-- Branding Image -->
            @guest
            <a class="navbar-brand" href="">
                {{ config('app.name', 'Verejná správa') }}
            </a>
            @endguest

            <!-- Branding Image -->
            @auth
            <a class="navbar-brand" href="{{ route('user.index', [auth()->user()->id, auth()->user()->slug])  }}">
                {{ auth()->user()->full_name() }}
            </a>
            @endauth

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                @if(auth()->guest())
                    <a id="zobrazit"  class="btn btn-info">Zoznam používateľov</a>
                @endif
            </ul>

        </div>




        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav nav justify-content-end">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Registrácia</a></li>
            @endguest

            @auth
                <li class="nav-item"><a class="nav-link" href="{{ url( Auth::user()->id) }}">Doklady</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('post.create', [auth()->user()->id, auth()->user()->slug ]) }}">Nový doklad</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('company.index', [auth()->user()->id, auth()->user()->slug ]) }}">Dodávatelia</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('question.index', [auth()->user()->id, auth()->user()->slug ]) }}">Návody</a></li>


                {{--ADMIN Links--}}
                {{--@can('admin')--}}
                <li class="nav-item"><a class="nav-link" href="{{ url( Auth::user()->id, 'orderindex') }}">Orders
                        <div class="badge" style="background: red;color: white;font-size: 79%;">nové</div></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('worker.index', [auth()->user()->id, auth()->user()->slug ]) }}">Zamestnanci</a></li>
                {{--@endcan--}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('user.new-organization', [Auth::user()->id, Auth::user()->slug]) }}">Môj Profil</a>
                        {{--@can('admin',  Auth::user())--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url( 'admin/user') }}">Zoznam regist.</a>
                        {{--@endcan--}}

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
            @endauth
        </ul>
    </div>
</nav>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

