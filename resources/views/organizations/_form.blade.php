<div class="md:flex">

    {{--SITE A --}}
    <div class="max-w-sm md:p-4">

        {{-- Title Field --}}
        <div class="flex mb-6">
                <label class="input-label flex-shrink-0" id="basic-addon1">Firma</label>
            <input type="text" name="name" class="input-control"  placeholder="Názov firmy" value="{{ old('name') ?? $organization->name }}" />
        </div>

        {{-- Ulica --}}
        <div class="flex mb-6">
                <label class="input-label flex-shrink-0" id="basic-addon2">Ulica a číslo</label>
            <input type="text" name="street" class = "input-control"  placeholder="Ulica a číslo" value="{{ old('street') ?? $organization->slug}}" />
        </div>

        {{-- PSČ --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon3">PSČ</label>
            <input type="number" name="psc" class = "input-control"  placeholder="Poštové smerové číslo" value="{{ old('psc') ?? $organization->psc }}" aria-describedby="basic-addon3" required/>
        </div>

        {{-- Mesto --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon4">Mesto</label>
            <input type="text" name="city" class = "input-control"  placeholder="Mesto" value="{{ old('city') ?? $organization->city}}" aria-describedby="basic-addon4" required/>
        </div>

        {{-- Email --}}
        <div class="flex mb-6">

            <label class="input-label flex-shrink-0" id="basic-addon5">Email</label>

            <input type="email" name="email" class = "input-control"  placeholder="Email dodávateľa" value="{{ old('email') ?? $organization->email }}" aria-describedby="basic-addon5" required/>
        </div>

        {{-- Phone --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon6">Telefón</label>
            <input type="text" name="phone" class = "input-control"  placeholder="Telefón dodávateľa" value="{{ old('phone') ?? $organization->phone }}" aria-describedby="basic-addon6"/>
        </div>


    </div>

    {{--SITE B --}}
    <div class="max-w-sm md:p-4">
        {{-- ICO Field --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon7">IČO</label>
            <input type="number" name="ico" class = "input-control"  placeholder="IČO organizácie" value="{{ old('ico') ?? $organization->ico }}" maxlength="8" aria-describedby="basic-addon7"/>
        </div>

        {{-- DIČ Field --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon8">DIČ</label>
            <input type="text" name="dic" class = "input-control"  placeholder="DIČ dodávateľa" value="{{ old('dic') ?? $organization->dic }}" aria-describedby="basic-addon8"/>
        </div>

        {{-- IC DIČ Field --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="basic-addon9">IC DIČ</label>
            <input type="text" name="ic_dic" class = "input-control"  placeholder="IC DIČ pre plátcov DPH" value="{{ old('ic_dic') ?? $organization->ic_dic }}" aria-describedby="basic-addon9"/>
        </div>


{{--        <div class="font-bold mb-4">Fakturačné údaje</div>--}}

        {{-- Bank account--}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="banka">Názov banky</label>
            <input type="text" name="bank_name" class = "input-control"  placeholder="Bankový účet" value="{{ old('bank_name') ?? $organization->bank_name}}" aria-describedby="banka"/>
        </div>

        {{-- Bank No --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="bankaNo">Číslo účtu</label>
            <input type="text" name="bank_number" class = "input-control"  placeholder="Číslo účtu" value="{{ old('bank_number') ?? $organization->bank_number }}" aria-describedby="bankaNo"/>
        </div>

        {{-- IBAN --}}
        <div class="flex mb-6">
            <label class="input-label flex-shrink-0" id="bankaNo">IBAN</label>
            <input type="text" name="bank_iban" class = "input-control"  placeholder="Iban" value="{{ old('bank_iban') ?? $organization->bank_iban}}" aria-describedby="bankaNo"/>
        </div>

        {{-- Save button --}}
        <div class="form-group">
            <button type="submit" class="btn btn-blue w-full">Uložiť</button>
        </div>


    </div>



</div>


