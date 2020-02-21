@extends('layouts.app')

@section('navigation')
    @include('organizations.navigation')
@endsection

@section('content')

    <h1 style="color: brown" class="text-center">@if( !empty(\Auth::user()->company)) {{ Auth::user()->company }}@endif<small> Zoznam objednávok</small></h1>
    <a href="{{ route('order.create', [ Auth::user()->id, Auth::user()->slug]) }}"><button class="btn btn-danger pull-right"><strong>+</strong> Nová objednávka</button></a>

    <order-list  :orders="{{ $orders }}"></order-list>

    {{--<table class="table">--}}
        {{--<thead class="bg-success">--}}
        {{--<tr>--}}
            {{--<th>Por.</th>--}}
            {{--<th>Dodávateľ</th>--}}
            {{--<th>Mesto</th>--}}
            {{--<th>Vystavená</th>--}}
            {{--<th>Platba</th>--}}
            {{--<th>Podpísal</th>--}}
            {{--<th>Suma</th>--}}
            {{--<th>Status</th>--}}
            {{--<th>Panel</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}

        {{--<tbody>--}}
        {{--@forelse($orders as $order)--}}
        {{--<tr>--}}
            {{--<td title="Zobraziť objednávku"><a href="{{ url($order->user->slug, 'ordershow'). '/'. $order->id }}"><strong>{{ $order->order_number  }}</strong>/{{ $order->created_at->format('Y') }}</a></td>--}}
            {{--<td><strong>{{ $order->customer->company }}</strong></td>--}}
            {{--<td>{{ $order->customer->city }}</td>--}}
            {{--<td>{{ $order->orderPublished }}</td>--}}
            {{--<td>{{ $order->payment }}</td>--}}
            {{--<td>{{ $order->worker->firstName }}/ <strong>{{ $order->worker->position }}</strong></td>--}}
            {{--<td> <strong>{{ number_format($order->orderItems->sum('price') * $order->orderItems->sum('quantity') , 2, ',', ' ') }} </strong></td>--}}
            {{--<td title="Zmeniť status objednávky"> @if( $order->order_send)--}}
                {{--<span style="color: green">Odoslaná</span>@else--}}
                {{--<div style="color: red">Neodoslaná</div> @endif--}}
            {{--</td>--}}


            {{--<td>--}}
                {{--{!! Form::open([ 'route' => ['deleteOrder', $order->id ] , 'method' => 'delete', 'class' => 'post', 'id' => 'delete-form']) !!}--}}
                {{--<a @if(Auth::id() === $order->user_id) @else style="color: grey" @endif class="faicons" href="{{ url($order->user->slug . '/orderedit', $order->id) }}"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť objednávku"></i></a>--}}
                {{--<a @if(Auth::id() === $order->user_id) @else style="color: grey" @endif  class="faicons" href="{{ url($order->user->slug . '/ordershow', $order->id) }}/pdf" target="_blank"><i class="fa fa-print" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vytlačiť"></i></a>--}}
                {{--<a @if(Auth::id() === $order->user_id) @else style="color: grey" @endif  class="faicons" href="{{ url($order->user->slug . '/ordercopy', $order->id) }}"><i class="fa fa-copy" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Kopírovať"></i></a>--}}
                {{--<a href="" onclick="get_form(this).submit(); return false"><i @if(Auth::id() === $order->user_id) @else style="font-size: 118%;color: grey;" @endif style="font-size: 118%; color: #b40000" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať objednávku"></i></a>--}}
                {{--{!! Form::close() !!}--}}
            {{--</td>--}}

        {{--</tr>--}}
            {{--@empty--}}
            {{--<tr><td>Bez záznamu</td></tr>--}}
            {{--@endforelse--}}
        {{--</tbody>--}}
    {{--</table>--}}

@endsection

{{--@section('script')--}}
    {{--<script>--}}

        {{--function get_form( element )--}}
        {{--{--}}

            {{--var r = confirm("Vymazať položku?");--}}

            {{--while( element )--}}
            {{--{--}}
                {{--element = element.parentNode;--}}

                {{--if( element.tagName.toLowerCase() == "form" )--}}
                {{--{--}}

                    {{--if (r == true) {--}}
                        {{--return element--}}
                    {{--} else {--}}
                        {{--return 0;--}}
                    {{--}--}}
                    {{--return element--}}
                {{--}--}}
            {{--}--}}
{{--//        return 0; //error: no form found in ancestors--}}
        {{--}--}}

    {{--</script>--}}
    {{--@endsection--}}
