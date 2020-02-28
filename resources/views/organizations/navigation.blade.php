
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('org.index', [$organizationNav->id, $organizationNav->slug])  }}">
                {{ $organizationNav->name }}
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

                <li class="nav-item"><a class="nav-link" href="{{ route('org.post.index', [$organizationNav->id, $organizationNav->slug ]) }}">Zverejňovanie</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('org.contact.index', [$organizationNav->id, $organizationNav->slug ]) }}">Kontakty</a></li>

                {{--@can('admin')--}}
                <li class="nav-item"><a class="nav-link" href="{{ route('order.index', [$organizationNav->id, $organizationNav->slug]) }}">Objednávky</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('question.index', [auth()->user()->id, auth()->user()->slug ]) }}">Návody</a></li>

            {{--@endcan--}}



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->full_name() }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('org.edit', [$organizationNav->id, $organizationNav->slug]) }}">Upraviť profil</a>
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

