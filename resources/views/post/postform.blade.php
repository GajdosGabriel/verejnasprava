
<!-- Three columns -->
<div class="md:flex mb-4">
    <div class="md:w-1/3 p-2">
        <label class="font-semibold" for="category">Typ dokladu</label>
        <select id="category" name="category_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="md:w-1/3 p-2 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <label class="font-semibold">Dodávateľ</label>
        <select name="contact_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required id="exampleSelect1">
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

    <div class="md:w-1/3 p-2">
        <label class="font-semibold" for="dateIn">Doručené dňa</label>
        <input type="date" name="date_in" value="{{ old('date_in') ?? date('Y-m-d') }}" id="dateIn" class="input-control focus:outline-none focus:shadow-outline" required>
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>
</div>

    {{--Title Field--}}
    <div class="w-full my-4 p-2">
        <label class="font-semibold" for="title">Popis dokladu</label>
        <input class="input-control focus:outline-none focus:shadow-outline" type="text" name="name" value="{{ old('name') ?? $post->name }}" placeholder="Názov položky" id="title"  required>
    </div>


    <div class="md:flex mb-4">
        <div class="md:w-1/3 p-2">
            <label class="font-semibold" for="price">Faktúrovaná cena</label>
            <input type="number" name="price" value="{{ old('price') ?? $post->price }}" placeholder="Suma faktúry (Euro)" step="any" id="price" class="input-control focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="md:w-1/3 p-2">
            <label class="font-semibold" for="number_invoice">Var. symbol</label>
            <input type="text" name="number_invoice" value="{{ old('number_invoice')  ?? $post->number_invoice  }}" placeholder="Dod. Číslo faktúry" id="number_invoice" class="input-control focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="md:w-1/3 p-2">
            <label class="font-semibold" for="noInvoice">Číslo faktúry / objednávky</label>
            <input type="text" name="int_number" value="{{ old('int_number')  ?? $post->int_number }}" placeholder="Interné číslo dokladu" id="noInvoice" class="input-control focus:outline-none focus:shadow-outline">
            {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
        </div>
    </div>


    <div class="my-5 mb-8 flex">
        <div class="w-1/2">
            <label class="block font-semibold" for="filename">Príloha</label>
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
                    <li class="text-gray-600">Bez prílohy</li>
                @endforelse
            </ul>
        </div>
        @endif
    </div>



<div class="mb-8">
    {{-- Add post Field --}}
    <div class="flex justify-between">
        <button class="btn bg-gray-200"><a href="{{ URL::previous() }}"></a>Späť</button>
        <button type="submit" class="btn btn-blue mx-2 w-1/6 shadow-md">Uložiť</button>
    </div>

</div>
