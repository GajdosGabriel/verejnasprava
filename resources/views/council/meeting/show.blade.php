@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


    <div class="col-md-12 d-flex justify-content-between">
        <h1>{{ $council->name }} zastupiteľstvo</h1>
        <a href="{{ route('item.create', [ $council->id, $council->slug ]) }}" class="btn btn-secondary">Nový návrh</a>
    </div>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-8">
            @forelse($council->items as $item)
                <div class="card">
                    <div class="card-header">
                        <span class="badge badge-primary">Hlasovanie verejné</span>
                        <span class="badge badge-light">Do rozpravy</span>

                    </div>
                    <div class="card-body">
                        <h5>{{ $item->name }}</h5>
                        <p class="card-text"> {{ $item->description }}</p>
                        <p class="card-text"> Prílohy</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="#" class="btn btn-primary">Súhlasim</a>
                        <a href="#" class="btn btn-danger pull-right">Nesúhlasím</a>
                    </div>
                </div>
            @empty
                bez záznamu
            @endforelse
        </div>

        <div class="col-md-4">
            <a href="#" class="btn btn-secondary">Umožniť hlasovanie</a>
        </div>

    </div>

</div>




@endsection
