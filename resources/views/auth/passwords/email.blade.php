@extends('layouts.app')
@section('page-title', 'Resetovať heslo')

@section('navigation')
    <x-navigation.navPublic/> @endsection


@section('content')


        <div class="container mx-auto md:flex min-h-screen">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-2xl">Resetovať heslo</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
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
                                               class="input-control @error('email') is-invalid @enderror" name="email"
                                               placeholder="Vložte registračný email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Poslať resetovací link na email
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection
