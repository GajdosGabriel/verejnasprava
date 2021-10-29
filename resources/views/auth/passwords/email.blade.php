@extends('layouts.app')
@section('page-title', 'Resetovať heslo')

@section('navigation')
    <x-navigation.navPublic />
@endsection


@section('content')


    <x-page.login>
        <div class="w-full lg:w-4/12 px-4 bg-gray-100 ">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0 p-6">
                <div class="font-semibold text-2xl mb-9 text-center">Resetovať heslo</div>

                <div class="">
                    @if (session('status'))
                        <div class="font-semibold border-gray-500 border-2 rounded-md shadow-md p-4 mb-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Emailová
                                adresa</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                class=" rounded-md mb-6 @error('email') is-invalid @enderror px-3 py-3 placeholder-gray-400 text-gray-700 bg-white text-sm shadow focus:outline-none focus:shadow-outline w-full"
                                    name="email" placeholder="Vložte registračný email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <div class="w-full">
                                <button type="submit" class="btn btn-primary w-full">
                                    Poslať resetovací link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-page.login>

@endsection
