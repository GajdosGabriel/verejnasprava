@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <h3>Pridať dodávateľa</h3>
        <form action="{{ route('company.store', [auth()->user()->id, auth()->user()->slug ]) }}" method="post">
            @csrf @method('POST')
        @include('organizations._form')
        </form>


            <h1>Zoznam dodávateľov</h1>
    <table class="table table-bordered table-inverse table-hover">
        <thead class="alert-info">
        <tr>
            <th>Pč</th>
            <th>Názov firmy</th>
            <th>Adresa</th>
            <th>Psč</th>
            <th>Mesto</th>
            <th>Tel.</th>
            <th>Ičo</th>
            <th>Dič</th>
            <th>Email</th>
            <th>Panel</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php $i=0; ?>
            @forelse($companies as $company)
                    <?php ++$i; ?>
                <td>{{ $i }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->street }}</td>
                <td>{{ $company->format_psc }}</td>
                <td>{{ $company->city }}</td>
                <td>{{ $company->tel }}.</td>
                <td>{{ $company->ico }}</td>
                <td>{{ $company->dic }}</td>
                <td>{{ $company->email }}</td>
                <td><a href="{{ url($company->user->slug . '/customer', $customer->id) }}"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť"></i></a></td>
        </tr>
        @empty
            Bez záznamu
        @endforelse
        </tbody>
    </table>



    @endsection