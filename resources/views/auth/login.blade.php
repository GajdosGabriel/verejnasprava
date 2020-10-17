@extends('layouts.app')

@section('page-title', 'Prihlásenie')

@section('navigation') <x-navigation.navPublic /> @endsection

@section('content')

    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900" style="background-image: url(&quot;https://demos.creative-tim.com/tailwindcss-starter-project/static/media/register_bg_2.2fee0b50.png&quot;); background-size: 100%; background-repeat: no-repeat;"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-gray-600 text-sm font-bold">Prihlásenie cez</h6></div>
                            <div class="btn-wrapper text-center">
                                <a href="/auth/facebook"
                                    class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                                >Login cez Facebook</a>
{{--                                <button class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;"><img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/tailwindcss-starter-project/static/media/github.4ffd4fe7.svg">Github</button>--}}
{{--                                <button class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;"><img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/tailwindcss-starter-project/static/media/google.87be59a1.svg">Google</button>--}}
                            </div>
                            <hr class="mt-6 border-b-1 border-gray-400">
                        </div>

                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="text-gray-500 text-center mb-3 font-bold"><small>Prihlásenie cez údaje</small></div>
                            <form>
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Email</label>
                                    <input type="email" required name="email" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Email" style="transition: all 0.15s ease 0s;">
                                </div>
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="grid-password">Heslo</label>
                                    <input type="password" name="password" required class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="Heslo" style="transition: all 0.15s ease 0s;">
                                </div>
                                <div>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input id="customCheckLogin" type="checkbox" checked class="form-checkbox text-gray-800 ml-1 w-5 h-5" style="transition: all 0.15s ease 0s;"><span class="ml-2 text-sm font-semibold text-gray-700">Zapamätať ma</span></label>
                                </div>
                                <div class="text-center mt-6">
                                    <button class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full" type="submit" style="transition: all 0.15s ease 0s;">Prihlásiť sa</button>
                                </div>

                                <div class="flex flex-wrap mt-6">
                                    <div class="w-1/2"><a href="{{ route('password.request')  }}" class="text-gray-900"><small>Zabudnuté heslo?</small></a></div>
                                    <div class="w-1/2 text-right"><a href="/register" class="text-gray-900"><small>Vytvoriť nový účet</small></a></div>
                                </div>
                            </form>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Adresa</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">Heslo</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Pamätať si') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                       Zabudnuté heslo--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
