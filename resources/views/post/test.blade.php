@extends('layouts.app')

@section('content')

    <h1>Index Post</h1>
    <div class="btn-group pull-right" role="group" aria-label="...">
        <button type="button" class="btn btn-primary">Left</button>
        <button type="button" class="btn btn-default">Middle</button>
        <button type="button" class="btn btn-default">Right</button>
    </div>

    <table class="table table-bordered table-inverse table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Popis</th>
            <th>Category</th>
            <th>Dodávateľ</th>
            <th>Cena spolu</th>
            <th>Filename</th>
            <th>Dátum</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @forelse( $users as $post)
                <td>{{ $post->id }}</td>
                <td>{{ $post->name }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->customer->name }}</td>
                <td>{{ $post->price }},- Eu</td>
                <td>
                    @if (isset($post->file['filename']))
                        <a target="_blank" href="{{ URL::to('/')}}/download/{{ $post->file['filename'] }}">Pozrieť súbor</a>
                    @else
                        Bez súboru
                    @endif</td>

                <td>{{ $post->created_at }}</td>
        </tr>
        @empty
            Bez záznamu
        @endforelse



        </tbody>
    </table>
    <a href="{{ url('user', Auth::user()->id) }}/create"><button class="btn btn-info pull-right">Pridať faktúru</button></a>

{{--    {{ $users->links() }}--}}
    {!! $users ->render() !!}


    @endsection