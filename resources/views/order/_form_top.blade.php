<div class="card">
    <div class="card-header">Objednávka č.: <span style="font-size: 120%;">
            @if( !empty($order->order_number) )
                {{ $order->order_number }} - {{ $order->created_at->format('Y') }}
            @else
            {{ Auth::user()->orders()->count() + 1 }} - {{ date('Y') }}
            @endif
        </span>
    </div>
    <div class="col-md-12">

        <div class="row">


        {{--Left Site--}}
        <div class="col-md-6" style="border: solid 1px #9999ab; background: silver">
            <strong>Objednávateľ:</strong>
            <div class="pull-right">
                <strong style="font-size: 200%">{{ Auth::user()->company }}</strong> <br>
                {{ Auth::user()->street }} <br>
                <strong>{{ Auth::user()->psc }}  {{ Auth::user()->city }}</strong> <br>
                Ičo: {{ Auth::user()->ico }}
            </div>

            <div class="form-group input-group-sm col-md-6">
                <label>Úhrada:</label>
                <select name="payment" class="form-control" required >
                    <option value="" selected disabled>Typ úhrady</option>
                    <option selected value="Bankový prevod">Bankový prevod</option>
                    <option value="Hotovosť">Hotovosť</option>
                    <option value="Dobierka">Dobierka</option>
                </select>
            </div>

            <div class="form-group input-group-sm col-md-6">
                <label for="">Vystavená dňa</label>
                <input type="date" name="orderPublished" class="form-control" required>
            </div>



            <div class="form-group input-group-sm col-md-6">
                <label for="">Poznámka</label>
                <input type="text" name="notice" class="form-control input-sm " placeholder="Poznámka">
            </div>

        </div>
        {{--End of left site--}}


        {{--RIght site--}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleSelect2">Dodávateľ:</label>
                <select name="customer_id" class="form-control" required id="exampleSelect2">
                    <option value="" selected disabled >Vybrať dodávateľa</option>
                    @foreach($user->companies as $company)
                        <option value="{{ $company->id }}"
                                @if(! empty($order->company_id))
                                {{ ($order->company_id == $company->id) ? "selected" : "" }}
                                @endif
                        >{{ $company->name }} {{ $company->street }} {{$company->city}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        </div>
        {{--End of Rigth site--}}
    </div> {{-- End Panel Body --}}
</div>