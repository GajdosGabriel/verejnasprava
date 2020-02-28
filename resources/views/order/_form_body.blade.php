

    <div class="card">
        <div id="polozky" class="card-body">
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
{{--                    @forelse($organization->orderItems as $item)--}}
                        <tr class="my_row">
                        <td><textarea id="name" name="name[]" rows="1" cols="50" class="input">{{ old('name') ?? $item->name }}</textarea></td>
                        <td><input type="text" id="item" name="quantity[]" value="{{ old('quantity') ?? $item->quantity }}" class="item input"></td>
                        <td><input type="number" id="price" name="price[]" value="{{ old('price') ?? $item->price }}" class="price input"></td>
                        {{--<td><input type="text" id="total" name="total[]" class="total input" readonly="true"></td>--}}
                        <td><input type="button" name="delete" class="input" value="Zmazať" onclick="deleteRow(this)"></td>
                    </tr>
                        {{--@empty--}}
                        {{--prázdne--}}
                    {{--@endforelse--}}
                    </tbody>
            </table>
            {{--@include('order.formbottom')--}}
        </div>
    </div>







