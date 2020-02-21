@extends('layouts.app')

@section('content')

        <h2>Kopírovať objednávku</h2>

    {!! Form::model($order, ['route' => 'storeorder', 'method' => 'post', 'files'=> 'true', 'class' => 'post', 'id' => 'add-form' , 'enctype' => 'multipart/form-data'])  !!}
        @include('order.header')
        @include('order.form')

@endsection