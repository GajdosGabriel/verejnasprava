@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <div class="col-md-12">
            <div style="display: none" class="row" id="toggle">
                <h2>Nový zamestnanec</h2>

                <div class="col-md-12">
                <form action="{{ route('worker.store', [auth()->user()->id, auth()->user()->slug ]) }}" method="POST">
                    @csrf

                    @include('workers.workerForm')
                </form>
                </div>
            </div>
            <workers :workers="{{ $workers }}"></workers>
{{--            @include('workers.list')--}}
        </div>


    @endsection






