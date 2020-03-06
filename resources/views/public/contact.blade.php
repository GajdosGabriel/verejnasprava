@extends('layouts.app')

@section('navigation')
    @include('public.navigation')
@endsection

@section('content')

    <h1>Napíšte nám</h1>
    <div class="row">
        <div class="col-md-6">
            <form method="POST">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="name">Meno</span>
                    </div>
                    <input type="text" name="name" class = "form-control"  placeholder="Meno" value="{{ old('name') }}" aria-describedby="name"/>
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="email">Email</span>
                    </div>
                    <input type="email" name="email" class = "form-control"  placeholder="Emailový kontakt" value="{{ old('email') }}" required aria-describedby="email"/>
                </div>


                <div class="input-group mb-3">
                    <textarea class="form-control" name="text" placeholder="Vaša správa ..." rows="7" required></textarea>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary float-right">Odoslať</button>
                </div>

            </form>
        </div>

    </div>


@endsection