<!-- Three columns -->
<div class="md:flex">
    <div class="md:w-1/3 p-2">
        <label class="input-label" for="category">Typ dokladu</label>
        <div class="relative">
            <select id="category" name="category_id"
                    class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="md:w-1/3 p-2 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <div class="flex justify-between">
            <label class="input-label">Dodávateľ</label>
            <new-contact-button/>
        </div>

        <div class="relative">
            <select name="contact_id"
                    class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                    required id="exampleSelect1">
                <option value="" selected disabled>Vybrať dodávateľa</option>
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
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label block" for="dateIn">Doručené dňa</label>
        <input type="date" name="date_in" value="{{ old('date_in') ?? date('Y-m-d') }}" id="dateIn"
               class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-1.5 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>
</div>

{{--Title Field--}}
<div class="w-full p-2">
    <label class="input-label" for="title">Popis dokladu</label>
    <input class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" type="text" name="name"
           value="{{ old('name') ?? $post->name }}" placeholder="Názov položky" id="title" required>
</div>


<div class="md:flex mb-5">
    <div class="md:w-1/3 p-2">
        <label class="input-label" for="price">Faktúrovaná cena</label>
        <input type="number" name="price" value="{{ old('price') ?? $post->price }}" placeholder="Suma faktúry (Euro)"
               step="any" id="price" class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label" for="number_invoice">Var. symbol</label>
        <input type="text" name="number_invoice" value="{{ old('number_invoice')  ?? $post->number_invoice  }}"
               placeholder="Dod. Číslo faktúry" id="number_invoice"
               class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label" for="noInvoice">Číslo faktúry / objednávky</label>
        <input type="text" name="int_number" value="{{ old('int_number')  ?? $post->int_number }}"
               placeholder="Interné číslo dokladu" id="noInvoice"
               class="input-control block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>
</div>



<div class="md:flex justify-between mb-5">

    <div class="flex flex-col w-2/3">
        <label class="input-label mb-2" for="filename">Prílohy</label>
        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">
    </div>


    {{--Zobrazenie prílohy--}}
    <div class="md:w-3/6">
        @if(isset($post))
            <div class="font-semibold mt-4">Prílohy</div>
            <ul>
                @forelse($post->files as $file)
                    <li class="flex justify-between">
                        {{ $file->org_name }}
                        <div style="margin-left: 20px">
                            <input type="checkbox" id="file{{ $file->id }}" name="fileDelete[]" value="{{ $file->id }}">
                            <label class="" for="file{{ $file->id }}"> Zmazať</label><br>
                        </div>
                    </li>
                @empty
                    <li class="text-gray-600">Žiadna príloha</li>
                @endforelse
            </ul>
        @endif
    </div>

</div>



<div class="mb-8">
    {{-- Add post Field --}}
    <div class="flex justify-between">
        <a class="px-4 hover:bg-gray-200 shadow-md border-gray-500 border-2 rounded-md text-center" href="{{ URL::previous() }}">Späť</a>
        <button type="submit" class="btn hover:bg-gray-200">Uložiť</button>
    </div>

</div>
