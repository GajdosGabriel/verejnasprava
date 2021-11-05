@extends('layouts.app')
@section('page-title', 'Program zasadnutia')


@section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <x-page.container>

        <x-page.page-title>
            <x-slot name="title">
                Návrhy
            </x-slot>

            <a class="btn btn-primary" href="{{ route('items.create') }}">Nový návrh</a>

        </x-page.page-title>

        <x-page.page3_3>

            <ul class="col-span-9 bg-white p-3">

                @forelse($items as $item)
                    <li class="flex justify-between border-b-2 hover:bg-gray-100 py-2 px-2">
                        <a href="{{ route('items.show', $item->id) }}">
                            <span class="font-semibold block">{{ $item->name }}</span>
                            <span class="text-xs">{{ $item->user->full_name() }}</span>
                        </a>


                        @forelse($item->meetings as $meeting)
                            <a href="{{ route('meetings.show', $meeting->id) }}">
                                <span class="p-1 bg-yellow-400 text-sm rounded-2xl px-2 hover:bg-yellow-500 ">
                                    {{ $meeting->name }} {{ $meeting->start_at->format('d. m. Y') }}
                                </span>
                            </a>
                        @empty

                            @can('council delete')
                                <form method="POST"
                                    action="{{ route('meetings.items.update', ['slugmeetings', $item->id]) }}">
                                    @csrf @method('PUT')
                                    <label for="meetings">Schôdza:</label>
                                    <select name="meeting" id="meetings" required>
                                        <option value="">---Vybrať---</option>
                                        @forelse($meetings as $meeting)
                                            <option value="{{ $meeting->id }}">{{ $meeting->start_at->format('d. m. Y') }}
                                                {{ \Str::limit($meeting->name, 12) }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <button class="btn btn-secondary">Zaradiť</button>
                                </form>
                            @endcan
                        @endforelse
                    </li>
                    @empty
                    @endforelse
            </ul>


                {{-- ASIDE --}}
                <div class="lg:w-1/4 md:px-6 px-4">

                </div>

            </x-page.page3_3>

            </div>


        </x-page.container>

    @endsection
