@extends('layouts.app')

@section('page-title', 'Registrácie')
@section('recaptcha') {!! htmlScriptTagJsApi(['action' => 'homepage']) !!} @endsection
@section('navigation') <x-navigation.navPublic /> @endsection

@section('content')
    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900" style="background-image: url(&quot;https://demos.creative-tim.com/tailwindcss-starter-project/static/media/register_bg_2.2fee0b50.png&quot;); background-size: 100%; background-repeat: no-repeat;"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 sm:px-0 pt-32">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-gray-600 text-sm font-bold">Registrácia cez</h6></div>
                            <div class="btn-wrapper text-center">
                                <a href="/auth/facebook"
                                    class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline"
                                >Registrácia cez Facebook</a>
                                {{--                                <button class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;"><img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/tailwindcss-starter-project/static/media/github.4ffd4fe7.svg">Github</button>--}}
                                {{--                                <button class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs" type="button" style="transition: all 0.15s ease 0s;"><img alt="..." class="w-5 mr-1" src="https://demos.creative-tim.com/tailwindcss-starter-project/static/media/google.87be59a1.svg">Google</button>--}}
                            </div>
                            <hr class="mt-6 border-b-1 border-gray-400">
                        </div>
                    <form class=" px-6 py-6" method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="first_name">Meno</label>
                            <input id="first_name" type="text" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div  class="relative w-full mb-3">
                            <label for="last_name" class="block uppercase text-gray-700 text-xs font-bold mb-2">Priezvisko</label>
                            <input id="last_name" type="text" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="relative w-full mb-3">
                            <label for="email" class="block uppercase text-gray-700 text-xs font-bold mb-2">E-Mailová Adresa</label>
                            <input id="email" type="email" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="relative w-full mb-3">
                            <label for="password" class="block uppercase text-gray-700 text-xs font-bold mb-2">Heslo</label>
                            <input id="password" type="password" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="relative w-full mb-3">
                            <label for="password-confirm" class="block uppercase text-gray-700 text-xs font-bold mb-2">Zopakovať heslo</label>
                            <input id="password-confirm" type="password" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" name="password_confirmation" required autocomplete="new-password">
                        </div>

{{--                        <div class="relative w-full mb-3">--}}
{{--                            <label for="iamHuman" class="block uppercase text-gray-700 text-xs font-bold mb-2">Som človek 3 + 2 =</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="iamHuman" type="number" class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full" placeholder="napíšte číslo 5" name="iamHuman" required>--}}

{{--                                @error('iamHuman')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="relative w-full mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </form>
                    </div>
                    <div class="flex flex-wrap mt-6">
                        <div class="w-1/2"><a href="#pablo" class="text-gray-300"><small>Forgot password?</small></a></div>
                        <div class="w-1/2 text-right"><a href="#pablo" class="text-gray-300"><small>Create new account</small></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
