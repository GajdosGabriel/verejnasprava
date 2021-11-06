@extends('layouts.app')
@section('page-title', 'Zoznam zastupiteľstiev')

@section('navigation') @include('organizations.navigation') @endsection

@section('content')


    <x-page.container>
        <x-page.page3_3>
            <div class="col-span-9 bg-white p-3">

                <council-table></council-table>

                {{-- Show if any councils dont exists --}}
                @if (!$councils->count() > 0)
                    @role('admin')
                        <a class="btn btn-primary float-right"
                            href="{{ route('organizations.councils.create', auth()->user()->active_organization) }}">
                            Nové zastupiteľstvo
                        </a>
                    @endrole
                @endif
            </div>
        </x-page.page3_3>
    </x-page.container>



@endsection
