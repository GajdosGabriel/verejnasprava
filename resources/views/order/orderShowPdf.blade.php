<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Verejný portál.eu</title>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}

    <link href="{{ URL::asset('css/2bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <style>
        body { font-family: DejaVu Sans, sans-serif !important; }
    </style>

</head>
<body>




                <span style="font-size: 115%;"> Objednávka č.: <strong>
            @if( !empty($order->order_number) )
                        {{ $order->order_number }}/{{ $order->created_at->format('Y') }}
                    @else
                        {{ Auth::user()->orders()->count() + 1 }} - {{ date('Y') }}
                    @endif
                    </strong></span>



            <table  class="table table-sm" style="border: 3px solid #9e9e9e">
                <thead style="background: #9e9e9e; ">
                <tr>
                    <td><strong>Odberateľ:</strong></td>
                    <td><strong>Dodávateľ:</strong></td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><strong>{{ Auth::user()->company }}</strong> <br>
                        {{ Auth::user()->street }} <br>
                        {{ Auth::user()->psc }}  {{ Auth::user()->city }}
                    </td>
                    <td><strong>{{ $order->company->name }}</strong> <br>
                        {{ $order->company->street }} <br>
                        {{ $order->company->psc }}  {{ $order->company->city }}
                    </td>
                </tr>
                <tr>
                    <td>ICO: {{ Auth::user()->ico }} <br>
                    DIC: {{ Auth::user()->ico }}

                    </td>
                    <td>ICO: {{ $order->company->ico }} <br>
                    DIC: {{ $order->company->ico }}

                    </td>
                </tr>

                <tr>
                    <td>Email: {{ Auth::user()->email }} <br>
                        Tel.: {{ Auth::user()->phone }} / Meno:  {{ $order->worker->firstName }}

                    </td>
                    <td>Emai: {{ $order->company->email }} <br>
                        Tel.: {{ $order->company->phone }} / Meno: xxxx
                    </td>
                </tr>
                </tbody>
            </table>

            <div style="border: solid 1px #72727f; background: silver; padding: 10px;margin-bottom: 10px">
                <strong>Platobné údaje:</strong> <br>
                    <strong>Platba:</strong>
                    {{ $order->payment }} <br>
                    <span>Vystavená dňa:</span>
                    {{ $order->orderPublished }} <br>
                    <span>Vystavil:</span>
                    {{ $order->worker->firstName }} <br>
                    <span>Poznámka:</span>
                    {{ $order->notice }}
            </div>





            <table class="table is-striped table-sm">
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
                        <td>{{ $item->quantity * $item->price }},- €</td>
                    </tr>
                @empty
                    <p>Bez položiek</p>
                @endforelse
                </tbody>
                <tfoot>
                <tr class="bg-success">
                    <td><strong>Celkom:</strong> 100.- €</td>
                </tr>
                </tfoot>
            </table>


                <div style="border: solid 1px #72727f; background: silver; padding: 10px;margin-bottom: 10px">
                    <strong>Objednávku podpísal:</strong> {{ $order->worker->firstName }} / Funkcia: dfasdf<br>
                </div>

</body>
</html>