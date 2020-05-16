@extends('layouts.app')

@section('page-title', 'Úvodná stránka')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')



        <div class="row">
            <div class="col-md-8">
                <h2>Organization index</h2>
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
            <div class="col-md-4">
                @can('admin')
                <h2>História aktivít</h2>
                <ul class="list-group">
                    @forelse($activities as $activity)
                        @include("organizations.activities.{$activity->type}")
                    @empty
                        <p>Bez záznamu</p>
                    @endforelse
                </ul>
                @endcan
            </div>
        </div>




@endsection
