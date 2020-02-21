

    <div class="panel panel-default">
        <div id="polozky" class="panel-body">
            <table class="table is-striped">
                <thead>
                <tr>
                    <th>Popis</th>
                    <th>Počet</th>
                    <th>Cena/ks</th>
                    <th>Spolu</th>
                    <th>Akcia</th>
                </tr>
                </thead>
                    <tbody class="my_table" id="my_table">
                    @foreach($order->orderItems as $item)
                        <tr class="my_row">
                        <input type="hidden" name="orderItemId[]" value="{{$item->id}}">
                        <td><textarea id="name" name="name[]" rows="1" cols="50" class="input">{{ $item->orderItem }}</textarea></td>
                        <td><input type="text" id="item" name="quantity[]" value="{{ $item->quantity }}" class="item input"></td>
                        <td><input type="number" id="price" name="price[]" value="{{ $item->price }}" class="price input"></td>
                        <td><input type="text" id="total" name="total[]" class="total input" readonly="true"></td>
                        <td><input type="button" name="delete" class="input" value="Zmazať" onclick="deleteRow(this)"></td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
            {{--@include('order.formbottom')--}}
        </div>
    </div>







