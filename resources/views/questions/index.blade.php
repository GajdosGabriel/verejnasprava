@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2>Máte otázku</h2>
                <div class="card">
                    <div class="card-header">Napíšte otázku || Položiť otázku, poslať podnet</div>
                    <form action="{{ route('question.store', [  auth()->user()->id,  auth()->user()->slug ]) }}" method="POST">
                        @csrf

                        <div class="card-footer">
                            <div class="input-group">
                                <input type="text" name="question" placeholder="Napíšte správu ..." class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" id="btn-chat">Poslať</button>
                        </span>
                            </div>
                        </div>
                    </form>
                    <div class="card-body">


                        @forelse($questions as $question)

                            {{-- User --}}
                            <div class="media">
                                <img style="width:8%" src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="align-self-start mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">Top-aligned media</h5>
                                    <p>{{ $question->question }}</p>
                                </div>
                            </div>

                            {{-- Administrátor --}}
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Administrátor</h5>
                                    <p>{{ $question->question }}</p>
                                </div>
                                <img style="width:8%" src="{{asset('image/administrator.jpg')}}" class="ml-3" alt="...">
                            </div>
                        @empty
                            Zatiaľ ste sa nepoložili žiadnu otázku.
                        @endforelse
                    </div>
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>


<div class="mt-5"></div>
        <div class="col-sm-6">

    </div>




    @endsection

@section('script')

@endsection
