<div class="row">
    <div class="form-group col-sm-3">
        <label for="categor">Typ dokladu</label>
        <select id="categor" name="category_id" class="form-control">
            @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-3 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <label>Dodávateľ</label>
        <select name="contact_id" class="form-control" required id="exampleSelect1">
            <option value="" selected disabled >Vybrať dodávateľa</option>
            @foreach(\App\Models\Contact::where('organization_id', '=',auth()->user()->active_organization)->get() as $contact)
                <option
                        @if( isset($post->contact->id) AND $post->contact->id == $contact->id )
                        selected
                        @endif
                        value="{{ $contact->id }}"
                >{{ $contact->name }}, {{ $contact->city }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group  col-sm-3 ">
        <label for="dateIn">Doručené dňa</label>
        <input type="date" name="date_in" value="{{ old('date_in') ?? date('Y-m-d') }}" id="dateIn" class="form-control" required>
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>

    <div class="form-group  col-sm-3 ">
        <label for="noInvoice">Číslo faktúry / objednávky</label>
        <input type="text" name="int_number" value="{{ old('int_number')  ?? $post->int_number }}" placeholder="Interné číslo dokladu" id="noInvoice" class="form-control">
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>

    {{--Title Field--}}
    <div class="form-group  col-sm-9 ">
        <label for="title">Popis dokladu</label>
        <input type="text" name="name" value="{{ old('name') ?? $post->name }}" placeholder="Názov položky" id="title" class="form-control form-control-lg" required>
    </div>

    <div class="form-group  col-sm-3 ">
        <label for="number_invoice">Var. symbol</label>
        <input type="text" name="number_invoice" value="{{ old('number_invoice')  ?? $post->number_invoice  }}" placeholder="Dod. Číslo faktúry" id="number_invoice" class="form-control" required>
    </div>

    <div class="form-group col-sm-3 ">
        <label for="price">Faktúrovaná cena</label>
        <input type="number" name="price" value="{{ old('price') ?? $post->price }}" placeholder="Suma faktúry (Euro)" step="any" id="price" class="form-control" required>
    </div>

    <div class="form-group col-sm-3 ">
        <label for="filename">Príloha</label>
        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">
    </div>



    {{--Zobrazenie prílohy--}}
    @if(isset($post))
    <div class="form-group col-sm-3">
        <strong>Príloha</strong>
        <ul>
            @forelse($post->files as $file)
                <li>{{ $file->org_name }}</li>
            @empty
                <li>Bez prílohy</li>
            @endforelse
        </ul>
    </div>
    @endif


</div>

<div class="col-md-12">
    {{-- Add post Field --}}
    <div class="row d-flex justify-content-between">
        <button class="btn btn-secondary btn-sm"><a href="{{ URL::previous() }}"></a>Späť</button>
        <button type="submit" class="btn btn-primary btn-block col-md-3">Uložiť</button>
    </div>

</div>
