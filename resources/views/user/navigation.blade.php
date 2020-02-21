
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('user.index', [auth()->user()->id, auth()->user()->slug])  }}">
                {{ auth()->user()->full_name() }}
            </a>


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
                <li class="nav-item"><a class="nav-link" href="{{ route('user.new-organization', [Auth::user()->id, Auth::user()->slug]) }}">Založiť organizáciu</a></li>
                {{--<li class="nav-item"><a class="nav-link" href="{{ route('worker.index', [auth()->user()->id, auth()->user()->slug ]) }}">Zamestnanci</a></li>--}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->email }}
                    </a>
                    <div class="dropdown-menu">
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
        </ul>
    </div>
</nav>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

