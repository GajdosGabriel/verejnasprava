@extends('layouts.app')

@section('navigation')
    @include('user.navigation')
@endsection

@section('content')

{{--Profil organizácie--}}
    <div class="col-md-6">
        <h3>Upraviť Profil <small>{{ $user->company }}</small></h3>
        <form action="{{ route('userupdate', [ $user->slug ]) }}" method="PUT" >
            @csrf @method('PUT')
            {{--@include('customers.customerForm')--}}
            @include('companies.bankForm')
        </form>

    </div>

    <div class="col-md-6">
        <h3>História aktivít</h3>
        <ul class="list-group">
            @forelse($activities as $activity)
                @include("user.activities.{$activity->type}")
                @empty
                <p>Bez záznamu</p>
            @endforelse
        </ul>
    </div>

    @endsection
