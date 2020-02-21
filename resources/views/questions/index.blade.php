@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')
        <div class="col-sm-6">
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



                    {{--Odpovede administrátora--}}
                        {{--@if($question->user->role == 'admin')--}}

                        <div class="media">
                            <img style="width: 8%" src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="ml-3" alt="...">

                            <div class="media-body">
                                <h5 class="mt-0">Otázka</h5>
                                {{ $question->question }}

                                <div class="media mt-3">
                                    <a class="mr-3" href="#">
                                        <img style="width: 50%" src="{{asset('image/administrator.jpg')}}" class="mr-3" alt="...">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mt-0">Odpoveď správcu</h5>
                                        {{ $question->question }}
                                    </div>
                                </div>
                            </div>
                        </div>
                            {{--<div class="row msg_container base_receive">--}}
                                {{--<div class="col-md-2 col-xs-2 avatar">--}}
                                    {{--<img src="{{asset('image/administrator.jpg')}}" class="img-thumbnail">--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-10 col-md-10">--}}
                                    {{--<div style="border: solid #d30000 2px; background: #c8c8c8; color: #0c0d0e; padding: 8px; font-size: 15px;margin-bottom: 10px; border-radius:6px; ">--}}
                                        {{--<p>{{ $question->question }}</p>--}}
                                        {{--<p style="font-size: 80%">{{  $question->created_at }}  <span class="pull-right" style="color: darkred; font-style: italic">{{ $question->user->slug }}</span></p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@else--}}

                    {{--Otázky usera--}}

                        {{--<div class="media">--}}
                            {{--<div class="media-body">--}}
                                {{--<h5 class="mt-0 mb-1">Otázka</h5>--}}
                                {{--{{ $question->question }}--}}
                            {{--</div>--}}
                            {{--<img style="width: 15%" src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="ml-3" alt="...">--}}
                        {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-10 col-md-10">--}}
                            {{--<div style="border: solid darkblue 2px;background: #c8c8c8; color: #0c0d0e; padding: 8px; font-size: 15px;margin-bottom: 10px; border-radius:6px; ">--}}
                                {{--<p>{{ $question->question }}</p>--}}
                                {{--<p style="font-size: 80%">{{  $question->created_at }}  <span class="pull-right" style="color: darkblue; font-style: italic">{{ $question->user->company }}</span></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2 col-xs-2 avatar">--}}
                            {{--<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class="img-thumbnail">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                        {{--@endif--}}
                @empty
                    Zatiaľ ste sa nepoložili žiadnu otázku.
                @endforelse
            </div>
                {{ $questions->links() }}
        </div>
    </div>




    @endsection

@section('script')

@endsection