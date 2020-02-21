
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('organization.index', [$organization->id, $organization->slug])  }}">
                {{ $organization->name }}
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

                <li class="nav-item"><a class="nav-link" href="{{ route('organization.posts', [$organization->id, $organization->slug ]) }}">Doklady</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('organization.posts.create', [$organization->id, $organization->slug ]) }}">Nový doklad</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('organization.companies', [$organization->id, $organization->slug ]) }}">Dodávatelia</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('question.index', [auth()->user()->id, auth()->user()->slug ]) }}">Návody</a></li>


                {{--ADMIN Links--}}
                {{--@can('admin')--}}
                <li class="nav-item"><a class="nav-link" href="{{ route('organization.orders', [$organization->id, $organization->slug]) }}">Objednávky
                        <div class="badge" style="background: red;color: white;font-size: 79%;">nové</div></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('organization.workers', [$organization->id, $organization->slug]) }}">Zamestnanci</a></li>
                {{--@endcan--}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->full_name() }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('organization.edit', [$organization->id, $organization->slug]) }}">Upraviť profil</a>
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

