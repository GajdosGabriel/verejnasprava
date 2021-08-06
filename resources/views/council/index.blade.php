@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

    @section('navigation') @include('organizations.navigation') @endsection

@section('content')


    <x-page.container>
        <div class="w-2/3">

            <council-table></council-table>

            {{-- Show only first councils --}}
            @if (!$councils->count() > 0)

                @role('admin')
                <a class="btn btn-primary float-right"
                    href="{{ route('organizations.councils.create', auth()->user()->active_organization) }}">Nové
                    zastupiteľstvo</a>
                @endrole
            @endif
        </div>

    </x-page.container>



@endsection
