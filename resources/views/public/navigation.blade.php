<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ route('home.index')}}">
            {{ config('app.name', 'Verejná správa') }}
        </a>

        {{--collapse --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
{{--            <ul class="nav navbar-nav">--}}
{{--                &nbsp;--}}
{{--                    <a id="zobrazit"  class="btn btn-info">Zoznam používateľov</a>--}}
{{--            </ul>--}}


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home.zverejnovanie') }}">Zverejňovanie</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home.contact') }}">Kontakt</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Registrácia</a></li>
            </ul>

        </div>
    </div>
</nav>

{{--<img style="width: 100%" src="{{ asset('image/public-header.jpg') }}">--}}
{{--@include('user.listAllUsers')--}}

