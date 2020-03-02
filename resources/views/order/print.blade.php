<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verejný portál.eu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">--}}

    <style>
        {{--body { font-family: DejaVu Sans, sans-serif !important; }--}}

    </style>



</head>
<body>

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
                        <strong>{{ $order->organization->psc }}  {{ $order->organization->city }}</strong> <br>
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
                        <strong>{{ $order->contact->psc }}  {{ $order->contact->city }}</strong> <br>
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


</body>
</html>