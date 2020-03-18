@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

        <h2>Objednávka</h2>
        <div>
            <div>Objednávka č.:
                    <span style="font-size: 120%;">
                        @if( isset($order->order_number) )
                            {{ $order->order_number }} / {{ $order->created_at->format('Y') }}
                        @else
                            {{ $order->organization()->orders()->count() + 1 }} /{{ date('Y') }}
                        @endif
                    </span>
            </div>
        </div>

        <div class="col-md-12 border border-secondary">
            <div class="row">

                {{--Left Site--}}
                <div class="col-md-6" style="border: solid 1px #72727f; background: #e5e5e5">
                    <strong>Objednávateľ:</strong>
                    <div>
                        <strong style="font-size: 200%">{{ $order->organization->name }}</strong> <br>
                        {{ $order->organization->street }}, <br>
                        <span>{{ $order->contact->psc }}</span>  <strong>{{ $order->contact->city }}</strong> <br>
                        Ičo: {{ $order->organization->ico }}
                    </div>

                    <strong>Platba:</strong>
                    {{ $order->payment }}<br>
                    <span>Vystavená dňa:</span>
                    {{ $order->created_at }}<br>
                    <span>Odoslaná dňa:</span>
                    @if(isset($order->order_send))
                    {{ $order->order_send }}<br>
                    @else
                        neodoslaná <br>
                    @endif
                    <span>Vystavil:</span>
                    {{ $order->user->full_name() }} <br>
                    <span>Poznámka</span>
                    {{ $order->notice }}
                </div>

                {{--Right site--}}
                <div class="col-md-6">
                    <strong>Dodávateľ:</strong>
                    <div>
                        <strong style="font-size: 200%">{{ $order->contact->name }}</strong> <br>
                        {{ $order->contact->street }}, <br>
                        <span>{{ $order->contact->psc }}</span>  <strong>{{ $order->contact->city }}</strong> <br>
                        Ičo: {{ $order->contact->ico }}
                    </div>
                    <p></p>
                    <strong>Tel.:</strong>
                    {{ $order->contact->phone }} <br>
                    <strong>Email:</strong>
                    {{ $order->contact->email }}

                </div>

                {{--Items--}}
                <div class="col-md-12">
                    <div class="row">
                        <table class="table is-striped">
                                <thead>
                                <tr style="background: rgba(59, 59, 66, 0.72); color: whitesmoke">
                                    <th>Popis položky</th>
                                    <th>Počet</th>
                                    <th>Cena/ks</th>
                                    <th>Dph</th>
                                    <th>Spolu</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($order->orderItems as $item)
                                    <tr>
                                        <td><strong>{{ $item->name }}</strong></td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->price_with_vat }}</td>
                                        <td>{{ $item->vat }}%</td>
                                        <td>{{ $item->price_total }},- Eu</td>
                                    </tr>
                                @empty
                                    <p>Bez položiek</p>
                                @endforelse

                                <tr style="background: #b90000; color: whitesmoke">
                                    <td>Sumár</td>
                                    <td>{{ $order->orderItems->sum('quantity') }} Kusov</td>
                                    <td></td>
                                    <td></td>
                                    <td>Celkom: {{ $order->amount }}</td>
                                </tr>
                                </tbody>

                                {{--// Footer Start --}}
                                <table class="table">
                                    <thead>
                                        <tr class="child">
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
