@extends('layouts.app')

@section('navigation') @include('organizations.navigation') @endsection


@section('content')

    <div class="container mx-auto p-6 min-h-screen">
        <div class="row">
            <div class="col-8">
                <h2 class="font-bold text-3xl">Vaše otázky</h2>

                <div class="card">
                    <div class="text-gray-700">Napíšte otázku alebo podnet.</div>

                    <div class="max-w-xl">

                        <form action="{{ route('support.store') }}" method="POST">
                            @csrf @method('POST')
                            <div class="flex justify-between my-4">
                                <input type="text" name="question" placeholder="Napíšte správu ..."
                                       class="flex-1 mr-3 pl-3 rounded-lg border-2 border-gray-400" required>
                                <button class="btn btn-primary">Poslať</button>
                            </div>
                        </form>
                        @include('modul.errors')

                        @forelse($questions as $question)

                            {{-- User --}}
                            <div class="bg-gray-100 p-3 mb-4 rounded shadow-lg">
                                {{--                                <h2 class="font-bold text-lg text-gray-700 mb-2 text-center">Otázka</h2>--}}
                                <div class="flex justify-between mb-3 items-center">
                                    <div class="flex">
                                        <img class="mr-5 rounded-full w-12"
                                             src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"
                                             alt="..." alt="...">
                                        <span class="self-center text-sm text-gray-800">{{ $question->user->full_name() }}</span>
                                    </div>

                                    {{--  Delete form question --}}
                                    @can('delete', $question)
                                        <form action="{{ route('support.destroy', $question->id ) }}"
                                              method="POST" class="p-2 cursor-pointer text-gray-600">
                                            @csrf @method('DELETE')
                                            <button type="submit">x</button>
                                        </form>
                                    @endcan

                                </div>
                                <p>{{ $question->question }}</p>


                                <h2 class="font-bold text-lg text-gray-700 mt-5 text-center">Odpoveď</h2>


                                @forelse($question->comments as $comment)
                                    {{--  Answers --}}
                                    <div class="bg-blue-100 p-3 mb-4 rounded shadow-lg">
                                        <div class="flex justify-between items-center">
                                            <div class="flex">
                                                <img class="mr-5 rounded-full w-12"
                                                     src="{{asset('image/administrator.jpg')}}" alt="...">
                                                <span
                                                    class="self-center text-sm text-gray-800">{{ auth()->user()->full_name() }}</span>
                                            </div>

                                            {{--  Delete form --}}
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment->id ) }}"
                                                      method="POST" class="p-2 cursor-pointer text-gray-600">
                                                    @csrf @method('DELETE')
                                                    <button type="submit">x</button>
                                                </form>
                                            @endcan
                                        </div>
                                        <p>{{ $comment->body }}</p>

                                    </div>

                                @empty
                                    {{--        Bez záznamu.--}}
                                @endforelse


                                <div class="bg-blue-100 p-2 mb-4 rounded shadow-lg">
                                    <div class="flex justify-between items-center">
                                        <div class="flex w-full items-center">
                                            <img class="mr-5 rounded-full w-12"
                                                 src="{{asset('image/administrator.jpg')}}" alt="...">

                                            <form action="{{ route('support.update', $question->id) }}" method="POST"
                                                  class="w-full">
                                                @csrf @method('PATCH')
                                                <div class="flex">
                                                    <input name="body" type="text" required
                                                           class="w-full border-2 border-gray-400 rounded-l-g text-sm focus:outline-none"
                                                           placeholder="Odpoveď" aria-label="Recipient's username"
                                                           aria-describedby="button-addon2">
                                                    <button class="btn btn-primary rounded-r-lg text-sm" type="submit">
                                                        Poslať
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @empty
                            Nie je tu žiadna otázky.
                        @endforelse
                    </div>
                    {{--                    {{ $questions->links() }}--}}
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5"></div>
    <div class="col-sm-6">

    </div>


@endsection

