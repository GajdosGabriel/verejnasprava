@extends('layouts.app')

@section('content')


<div class="col-md-12">

    <div class="col-md-6">
    @foreach($sendemails as $sendemail)
            <span class="label label-danger">{{ $sendemail->id }}</span> {{$sendemail->company}}
    @endforeach
    </div>


    <div class="d-flex bd-highlight mb-3">

        <h1 class="mr-auto bd-highlight">Všetci klienti</h1>

        <div class="col-md-5 bd-highlight">
            <form action="{{ url('/mesacnyvypis') }}" role="form" method="post">
                @csrf
                <label>Mesačný výpís (id)</label>
                <input type="number" name="userid">
                <button type="submit" class="btn btn-primary">Odoslať</button>
            </form>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Organizácia</th>
            <th>Dokladov</th>
            <th>Suma Celkom</th>
            <th>Email</th>
            <th>Člen od:</th>
            <th>Ičo</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($users as $user)
            <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{ url( $user->slug) }}">{{ $user->company }}</a></td>
                    <td class="text-center">{{$user->posts->count()}}</td>
                    <td class="text-center">{{ number_format($user->posts->sum('price'))}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->ico }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <h2>Výpis za aktuálny mesiac</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Id</th>
            <th>Dátum</th>
            <th>Cena</th>
            <th>Klient</th>
            <th></th>
            <th>Názov položky</th>
            <th>Ičo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->price}},- Euro</td>
                <td>{{ $post->user->company }}<td>
                <td>{{ $post->name }}</td>
                <td>{{ $user->ico }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


{{--    {!! $users ->render() !!}--}}
</div>



@endsection

{{--<h3>Štatistika</h3>--}}
{{--<ul>--}}
    {{--<li>Počet obj. položiek {{ number_format($items->count()) }} </li>--}}
    {{--<li>Celková hod. {{ number_format($items->sum('price')) }} </li>--}}
    {{--<li>Počet kusov {{ $items->sum('quantity') }} </li>--}}
    {{--<li>Maximálna obj. {{ number_format($items->max('price')) }} </li>--}}
    {{--<li>Minimálna obj. {{ number_format($items->min('price')) }} </li>--}}
    {{--<li>Priemerná obj {{ number_format($items->avg('price')) }} </li>--}}
{{--</ul>--}}