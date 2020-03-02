@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')


        <h1>Organization index</h1>
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert">
                    Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</a>!
                </div>
                <div class="alert alert-secondary" role="alert">
                    Vystavovať <a href="#" class="alert-link">objednávky!</a>
                </div>
                <div class="alert alert-success" role="alert">
                    Evidencia <a href="#" class="alert-link">zamestnancov!</a>
                </div>
                <div class="alert alert-danger" role="alert">
                    Evidencia <a href="#" class="alert-link">dane a poplatky!</a>
                </div>
            </div>
            <div class="col">
                <div class="alert alert-primary" role="alert">
                    Zverejňovať <a href="#" class="alert-link">zmlúvy a faktúry</a>!
                </div>
                <div class="alert alert-secondary" role="alert">
                    Vystavovať <a href="#" class="alert-link">objednávky!</a>
                </div>
                <div class="alert alert-success" role="alert">
                    Evidencia <a href="#" class="alert-link">zamestnancov!</a>
                </div>
                <div class="alert alert-danger" role="alert">
                    Evidencia <a href="#" class="alert-link">dane a poplatky!</a>
                </div>
            </div>
            <div class="col">
                <h3>História aktivít</h3>
                <ul class="list-group">
                    @forelse($activities as $activity)
                        @include("organizations.activities.{$activity->type}")
                    @empty
                        <p>Bez záznamu</p>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>


@endsection