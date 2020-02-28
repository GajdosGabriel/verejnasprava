<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">

        <div class="navbar-header">

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home.index')}}">
                {{ config('app.name', 'Verejná správa') }}
            </a>

        </div>

        <div>
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
                    <a id="zobrazit"  class="btn btn-info">Zoznam používateľov</a>
            </ul>

        </div>


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav nav justify-content-end">
            <li class="nav-item"><a class="nav-link" href="{{ route('home.contact') }}">Kontakt</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Registrácia</a></li>
        </ul>
    </div>
</nav>

{{--list all users--}}

{{--@include('user.listAllUsers')--}}

