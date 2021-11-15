@extends('layouts.app')
@section('page-title', 'Nové heslo')

@section('navigation') <x-navigation.navPublic /> @endsection


@section('content')



<x-page.login>
    <div class="w-full lg:w-4/12 px-4 bg-gray-100 ">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0 p-6">
                <div class="text-2xl text-center mb-6 font-semibold">Zadanie nového hesla</div>

                <div class="text-center">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="flex flex-col mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Emailová adresa</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="rounded-md  @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <div class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nové heslo</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="rounded-md @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <div class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col mb-6">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Zopakovať heslo</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="rounded-md" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Resetovať heslo
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-page.login>
@endsection
