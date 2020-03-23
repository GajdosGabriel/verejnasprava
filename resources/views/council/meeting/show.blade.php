@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


    <div class="d-flex justify-content-between">
        <h1>{{ $council->name }} zastupiteľstvo</h1>
{{--        <a href="{{ route('item.store', [ ]) }}" class="btn btn-secondary">Nový návrh</a>--}}
    </div>

    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>


    </div>



@endsection
