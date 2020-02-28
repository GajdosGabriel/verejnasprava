

    <div class="card">
        <div class="card-body">
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
                    <tbody class="my_table">
                        <tr class="my_row">
                        <td><textarea class="form-control" placeholder="Objednávame ..." id="name" name="name[]" rows="1" cols="50">{{ old('name') }}</textarea></td>
                        <td><input type="number" name="quantity[]" value="{{ old('quantity') }}" class="form-control"></td>
                        <td><input type="number" name="price[]" value="{{ old('price') }}" class="form-control"></td>
                    </tbody>
            </table>
        </div>
    </div>







