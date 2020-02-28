@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <h2>Objednávka</h2>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Objednávka č.:
                <span style="font-size: 120%;">
            @if( !empty($order->order_number) )
                        {{ $order->order_number }} - {{ $order->created_at->format('Y') }}
                    @else
                        {{ $order->organization()->orders()->count() + 1 }} - {{ date('Y') }}
                    @endif
                </span>

                </div>
                <div class="card-body">

                    {{--Left Site--}}
                    <div class="col-md-6" style="border: solid 1px #72727f; background: silver">
                        <strong>Objednávateľ:</strong>
                        <div>
                            <strong style="font-size: 200%">{{ $order->organization->name }}</strong> <br>
                            {{ $order->organization->street }}, <br>
                            <strong>{{ $order->organization->psc }}  {{ $order->organization->city }}</strong> <br>
                            Ičo: {{ $order->organization->ico }}
                        </div>

                        <strong>Platba:</strong>
                        {{ $order->payment }}
                        <label for="">Vystavená dňa</label>
                        {{ $order->orderPublished }}
                        <label for="">Vystavil</label>
                        {{--{{ $order->contact->name }} <br>--}}
                        <label for="">Poznámka</label>
                        {{ $order->notice }}

                    </div>
                    {{--End of left site--}}


                    {{--Right site--}}
                    <div class="col-md-6">
                        <strong>Dodávateľ:</strong>
                        <div>
                            <strong style="font-size: 200%">{{ $order->contact->name }}</strong> <br>
                            {{ $order->contact->street }}, <br>
                            <strong>{{ $order->contact->psc }}  {{ $order->contact->city }}</strong> <br>
                            Ičo: {{ $order->contact->ico }}
                        </div>
                        <p></p>
                        <strong>Tel.:</strong>
                        {{ $order->contact->phone }} <br>
                        <strong>Email:</strong>
                        {{ $order->contact->email }}

                    </div>
                    {{--End of Rigth site--}}
                </div>
            </div>

            <div class="card">
                <div id="polozky" class="panel-body">
                    <table class="table is-striped">
                        <thead>
                        <tr style="background: rgba(59, 59, 66, 0.72); color: whitesmoke">
                            <th>Popis položky</th>
                            <th>Počet</th>
                            <th>Cena/ks</th>
                            <th>Spolu</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($order->orderItems as $item)
                            <tr>
                                <td><strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $grandSum = $item->quantity * $item->price }},- Eu</td>
                            </tr>
                        @empty
                            <p>Bez položiek</p>
                        @endforelse

                        <tr style="background: #b90000; color: whitesmoke">
                            <td>Celkom</td>
                            <td>{{ $order->orderItems->sum('quantity') }} Kusov</td>
                            <td></td>
                            <td>Suma spolu</td>
                        </tr>
                        </tbody>

                        {{--// Footer Start --}}
                        <table class="table" style="margin-bottom: 55px">
                            <thead>
                            <tr class="child">
                                <td></td>
                                <td colspan="2">----</td>

                                <td><strong>Počet </strong></td>
                                <td class="pull-right"><strong style="font-size: 115%">Celkom: ,- Eu</strong></td>
                                <td>

                                    <div class=" btn-group pull-right">
                                        @if(!$order->order_send)
                                            <button type="submit" name="order_send" value="1"  class="btn btn-danger btn-sm">Odoslať</button>
                                        @else
                                            <button type="submit" name="order_send" value="1" disabled class="btn btn-info btn-sm">Odoslaná</button>
                                        @endif
                                    </div>

                                </td>
                            </tr>
                            </thead>
                        </table>
                        {{--// Footer End --}}
                    </table>
                </div>
            </div>
        </div>

@endsection
