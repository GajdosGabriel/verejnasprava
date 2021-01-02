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
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>

    </div>
    <div class="md:w-1/3 p-2 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <label class="input-label">Dodávateľ</label>
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
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label" for="dateIn">Doručené dňa</label>
        <input type="date" name="date_in" value="{{ old('date_in') ?? date('Y-m-d') }}" id="dateIn"
               class="input-control focus:outline-none focus:shadow-outline" required>
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>
</div>

{{--Title Field--}}
<div class="w-full p-2">
    <label class="input-label" for="title">Popis dokladu</label>
    <input class="input-control focus:outline-none focus:shadow-outline" type="text" name="name"
           value="{{ old('name') ?? $post->name }}" placeholder="Názov položky" id="title" required>
</div>


<div class="md:flex mb-5">
    <div class="md:w-1/3 p-2">
        <label class="input-label" for="price">Faktúrovaná cena</label>
        <input type="number" name="price" value="{{ old('price') ?? $post->price }}" placeholder="Suma faktúry (Euro)"
               step="any" id="price" class="input-control focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label" for="number_invoice">Var. symbol</label>
        <input type="text" name="number_invoice" value="{{ old('number_invoice')  ?? $post->number_invoice  }}"
               placeholder="Dod. Číslo faktúry" id="number_invoice"
               class="input-control focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="md:w-1/3 p-2">
        <label class="input-label" for="noInvoice">Číslo faktúry / objednávky</label>
        <input type="text" name="int_number" value="{{ old('int_number')  ?? $post->int_number }}"
               placeholder="Interné číslo dokladu" id="noInvoice"
               class="input-control focus:outline-none focus:shadow-outline">
        {{--<input type="datetime-local" name="date_in" value="{{ old('date_in') ?? $post->date_in->format('Y-m-d\TH:i') }}" id="dateStart" class="form-control" required>--}}
    </div>
</div>


<div class="md:flex sm:flex-col text-sm mb-8 ">

    <div class="flex flex-col w-2/3">
        <label class="input-label mb-2" for="filename">Príloha</label>
        <input type="file" name="filename[]" value="{{ old('filename') }}" multiple placeholder="Príloha" id="filename">
    </div>


    {{--Zobrazenie prílohy--}}
    <div class="md:w-3/6">
        @if(isset($post))
            <span class="font-semibold mb-2">Príloha</span>
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
                    <li class="text-gray-600">Bez prílohy</li>
                @endforelse
            </ul>
        @endif
    </div>

</div>


<div class="mb-8">
    {{-- Add post Field --}}
    <div class="flex justify-between">
        <a class="btn bg-gray-200" href="{{ URL::previous() }}">Späť</a>
        <button type="submit" class="btn btn-primary mx-2 md:w-1/6 shadow-md">Uložiť</button>
    </div>

</div>
