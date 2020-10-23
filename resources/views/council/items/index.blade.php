@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


@section('navigation')
    <x-navigation.navigationOrganization/> @endsection

{{--@section('navigation') @include('council.items.navigation') @endsection--}}

@section('content')

    <div class="lg:container lg:flex mx-auto lg:px-6 min-h-screen py-6">

        <div class="lg:w-3/4 px-4 md:px-6  mb-6">

            <div class="flex justify-between items-center pb-8">

                <h1 class="page-title">Moje návrhy</h1>
                <a class="btn btn-primary"
                   href="{{ route('item.create') }}">Nový návrh</a>
            </div>
            <ul>

                @forelse($items as $item)
                    <li class="flex justify-between my-2 border-b-2 hover:border-gray-500">
                        <a href="{{ route('item.show', [$item->id, $item->slug]) }}">
                            {{ $item->id }}/{{ $item->name }}
                        </a>


                        @forelse($item->meetings as $meeting)
                            <a href="{{ route('meet.show', [$meeting->id, $meeting->slug]) }}">
                                <span class="p-1 bg-yellow-400 text-sm rounded-2xl px-2 hover:bg-yellow-500 ">
                                {{ $meeting->name }}
                                </span>
                            </a>
                        @empty

                            <form method="POST" action="{{ route('itemMeeting.update', $item->id) }}">
                                @csrf @method('PUT')
                                <label for="meetings">Do schôdze:</label>
                                <select name="meeting" id="meetings" required>
                                    <option value="">---Vybrať---</option>
                                    @forelse($meetings as $meeting)
                                        <option value="{{ $meeting->id }}">{{ $meeting->start_at->format('d. m. Y') }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <button>Uložiť</button>
                            </form>
                        @endforelse
                    </li>
                @empty
                @endforelse
            </ul>
        </div>

        {{-- ASIDE --}}
        <div class="lg:w-1/4 md:px-6 px-4">

        </div>

    </div>




@endsection
