@extends('layouts.app')
@section('page-title', 'Nové heslo')

@section('navigation') <x-navigation.navPublic /> @endsection


@section('content')



<div class="container mx-auto md:flex min-h-screen text-center justify-center">
    <div class="text-center">
        <div class="w-full">
            <div class="card">
                <div class="text-2xl">Zadanie nového hesla</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Emailová adresa</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="block input-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nové heslo</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class=" block input-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Zopakovať heslo</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="block input-control" name="password_confirmation" required autocomplete="new-password">
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
</div>
@endsection
