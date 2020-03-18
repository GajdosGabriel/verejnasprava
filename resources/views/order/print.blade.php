<!DOCTYPE html>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vaša objednávka - Verejný portál.eu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}

    <style>
        body { font-family: DejaVu Sans, sans-serif !important; }
    </style>
</head>
<body>
        <div>
            <strong>Objednávka č.:
                    <span style="font-size: 120%;">
                        @if( isset($order->order_number) )
                            {{ $order->order_number }} / {{ $order->created_at->format('Y') }}
                        @else
                            {{ $order->organization()->orders()->count() + 1 }} /{{ date('Y') }}
                        @endif
                    </span>
            </strong>
        </div>

        <table  class="table table-bordered">
            <thead>
            <tr style="background: #b4b4b4; width: 100%">
                <td>Objednávateľ:</td>
                <td>Dodávateľ:</td>
            </tr>
            </thead>
            <tr>
                <td>
                    <strong>{{ $order->organization->name }}</strong> <br>
                    {{ $order->organization->street }}, <br>
                    <span>{{ $order->organization->psc }}</span> <strong>{{ $order->organization->city }}</strong> <br>
                    Ičo: {{ $order->organization->ico }}

                    <strong>Platba:</strong> {{ $order->payment }}<br>
                    <span>Vystavená dňa:</span> {{ $order->created_at }}<br>
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
                </td>
                <td>
                    <strong>{{ $order->contact->name }}</strong> <br>
                    {{ $order->contact->street }}, <br>
                    <span>{{ $order->contact->psc }}</span>  <strong>{{ $order->contact->city }}</strong> <br>
                    Ičo: {{ $order->contact->ico }}

                    <p></p>
                    <strong>Tel.:</strong> {{ $order->contact->phone }} <br>
                    <strong>Email:</strong> {{ $order->contact->email }}
                </td>
            </tr>
        </table>

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

            <tr style="background: silver">
                <td>Celkom</td>
                <td>{{ $order->amount }} ks</td>
                <td></td>
                <td>Celkom</td>
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

</body>
</html>
