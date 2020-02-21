@extends('layouts.app')

@section('content')

    <h1>Kopírovať doklad  <i style="color: #1b3d8d" class="fa fa-copy"></i></h1>
    {!! Form::model($post, ['url' => [ auth()->user()->slug ,'posts'], 'method' => 'post', 'files'=> 'true', 'class' => 'post', 'id' => 'add-form']) !!}
   @include('post.postform')

    {{ Form::close() }}

    @endsection