@extends('layouts.app')

@section('content')

    <h1>Upraviť doklad <i style="color: #1b3d8d" class="fa fa-pencil"></i></h1>
    {!! Form::model($post, ['url' => ['update', $post->id ], 'method' => 'put', 'files'=> 'true', 'class' => 'post', 'id' => 'add-form']) !!}
   @include('post.postform')

    {{ Form::close() }}


    @endsection