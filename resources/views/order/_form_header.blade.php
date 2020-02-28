<div class="card">
     <div class="card-header">Objednávka č.: <strong style="font-size: 120%;">
            @if( !empty($order->order_number) )
                {{ $order->order_number }} / {{ $order->created_at->format('Y') }}
            @else
                {{ $organization->orders()->count() + 1 }} / {{ date('Y') }}
            @endif
        </strong>

        <a href="{{ url()->previous() }}" class="btn btn-default pull-right">Zrušiť</a>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6" style="border: solid 1px #9999ab; background: silver">
                <div class="row">
                    <div class="col-md-6">
                        <p>Objednávateľ:</p>
                        <div class="pull-left">
                            <strong style="font-size: 130%">{{ $organization->name }}</strong> <br>
                            {{ $organization->street }} <br>
                            <strong>{{ $organization->psc }}  {{ $organization->city }}</strong> <br>
                            Ičo: {{ $organization->ico }}
                        </div>
                    </div>

                <div class="col-md-6">
                    <div class="form-group input-group-sm">
                        <label>Úhrada:</label>
                        <select name="payment" class="form-control" required >
                            <option value="" selected disabled>Typ úhrady</option>
                            <option selected value="Bankový prevod">Bankový prevod</option>
                            <option value="Hotovosť">Hotovosť</option>
                            <option value="Dobierka">Dobierka</option>
                        </select>
                    </div>

                    {{--<div class="form-group input-group-sm col-md-6">--}}
                    {{--<label for="">Vystavená dňa</label>--}}
                    {{--<input type="datetime" name="published" value="{{ old('published') ?? date('Y-m-d') }}" class="form-control" required>--}}
                    {{--</div>--}}

                    <div class="form-group input-group-sm">
                        <label for="">Poznámka</label>
                        <input type="text" name="notes" class="form-control input-sm " placeholder="Poznámka">
                    </div>


                </div>
            </div>





        </div>
        {{--End of left site--}}


        {{--RIght site--}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleSelect2">Dodávateľ:</label>
                <select name="contact_id" class="form-control" required id="exampleSelect2">
                    <option value="" selected disabled >Vybrať dodávateľa</option>
                    @foreach($organization->contacts as $contact)
                        <option value="{{ $contact->id }}"
                                @if(! empty($order->contact_id))
                                {{ ($order->contact_id == $contact->id) ? "selected" : "" }}
                                @endif
                        >{{ $contact->name }} {{ $contact->street }} {{$contact->city}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        </div>
        {{--End of Rigth site--}}
    </div>
</div>