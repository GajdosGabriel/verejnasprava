<!DOCTYPE html>
<html lang="sk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pozvánka na zasadnutie</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif !important;
        }
    </style>
</head>
<body>

<div class="text-gray-500 underline text-center">{{  $organization->name }}, {{  $organization->street }} {{  $organization->psc }} {{  $organization->city }} </div>


<div class="text-center">
    <p class="m-5 text-gray-700 text-2xl">POZVÁNKA na zasadnutie</p>
    <p class="m-5">dňa: {{ $meeting->start_at->format('m. d. Y') }} o {{ $meeting->start_at->format('H:i') }} hod.</p>
    @if($meeting->locality ==! '')
    <p class="m-5">Miesto: {{ $meeting->locality }}</p>
    @endif
</div>



<p>Pozývame Vás na zasadanie {{ $meeting->council->name }}.</p>


<table class="w-full mt-5">
    <thead style="background: #b4b4b4; margin-bottom: 30px" class=" bg-gray-300">
    <tr>
        <th>Program zasadania</th>
    </tr>
    </thead>

    <tbody>
    <ol class="mr-12">
        @forelse($meeting->items as $item)
            <li>{{ $item->name }}</li>
        @empty
            <p>Žiadny prgram</p>
        @endforelse
    </ol>

    </tbody>
</table>

</body>
</html>
