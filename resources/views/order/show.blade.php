@extends('layouts.app')

@section('content')

        <h2>Objednávka</h2>

    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Objednávka č.:
                <span style="font-size: 120%;">
            @if( !empty($order->order_number) )
                        {{ $order->order_number }} - {{ $order->created_at->format('Y') }}
                    @else
                        {{ Auth::user()->orders()->count() + 1 }} - {{ date('Y') }}
                    @endif
                </span>

            </div>
            <div class="panel-body">

                {{--Left Site--}}
                <div class="col-md-6" style="border: solid 1px #72727f; background: silver">
                    <strong>Objednávateľ:</strong>
                    <div>
                        <strong style="font-size: 200%">{{ Auth::user()->company }}</strong> <br>
                        {{ Auth::user()->street }}, <br>
                        <strong>{{ Auth::user()->psc }}  {{ Auth::user()->city }}</strong> <br>
                        Ičo: {{ Auth::user()->ico }}
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-md-6">
                        <strong>Platba:</strong>
                        {{ $order->payment }}
                        <label for="">Vystavená dňa</label>
                        {{ $order->orderPublished }}
                        <label for="">Vystavil</label>
                        {{ $order->worker->firstName }} <br>
                        <label for="">Poznámka</label>
                        {{ $order->notice }}
                    </div>
                </div>
                {{--End of left site--}}


                {{--Right site--}}
                <div class="col-md-6">
                    <strong>Dodávateľ:</strong>
                    <div>
                        <strong style="font-size: 200%">{{ $order->company->name }}</strong> <br>
                        {{ $order->company->street }}, <br>
                        <strong>{{ $order->company->psc }}  {{ $order->company->city }}</strong> <br>
                        Ičo: {{ $order->company->ico }}
                    </div>
                    <p></p>
                        <strong>Tel.:</strong>
                        {{ $order->company->phone }} <br>
                        <strong>Email:</strong>
                        {{ $order->company->email }}

                </div>
                {{--End of Rigth site--}}
            </div>
        </div>

        <div class="panel panel-primary">
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
                            <td>{{ $item->orderItem }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $grandSum = $item->quantity * $item->price }},- Eu</td>
                        </tr>
                        @empty
                        <p>Bez položiek</p>
                        @endforelse

                    <tr style="background: #b90000; color: whitesmoke">
                        <td>Sumár objednávky</td>
                        <td>{{ $order->orderItems->sum('quantity') }} Kusov</td>
                        <td></td>
                        <td>Cena celkom</td>
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
