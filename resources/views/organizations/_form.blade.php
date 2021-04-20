<div class="md:flex">
    {{--SITE A --}}
    <div class="max-w-sm md:p-4">

        {{-- Title Field --}}
        <div class="mb-4">
                <label class="input-label" id="basic-addon1">Firma</label>
            <input type="text" name="name" class="w-full"  placeholder="Názov firmy" value="{{ old('name') ?? $organization->name }}" />
        </div>

        {{-- Ulica --}}
        <div class="mb-4">
                <label class="input-label" id="basic-addon2">Ulica a číslo</label>
            <input type="text" name="street" class="w-full"  placeholder="Ulica a číslo" value="{{ old('street') ?? $organization->street}}" />
        </div>

        {{-- PSČ --}}
        <div class="mb-4">
            <label class="input-label" id="basic-addon3">PSČ</label>
            <input type="number" name="psc" class="w-full"  placeholder="Poštové smerové číslo" value="{{ old('psc') ?? $organization->psc }}" aria-describedby="basic-addon3" required/>
        </div>

        {{-- Mesto --}}
        <div class="mb-4">
            <label class="input-label" id="basic-addon4">Mesto</label>
            <input type="text" name="city" class="w-full"  placeholder="Mesto" value="{{ old('city') ?? $organization->city}}" aria-describedby="basic-addon4" required/>
        </div>

        {{-- Email --}}
        <div class="mb-4">

            <label class="input-label" id="basic-addon5">Email</label>

            <input type="email" name="email" class="w-full"  placeholder="Email dodávateľa" value="{{ old('email') ?? $organization->email }}" aria-describedby="basic-addon5" required/>
        </div>

        {{-- Phone --}}
        <div class="mb-4">
            <label class="input-label" id="basic-addon6">Telefón</label>
            <input type="text" name="phone" class="w-full"  placeholder="Telefón dodávateľa" value="{{ old('phone') ?? $organization->phone }}" aria-describedby="basic-addon6"/>
        </div>


    </div>

    {{--SITE B --}}
    <div class="max-w-sm md:p-4">
        {{-- ICO Field --}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="basic-addon7">IČO</label>
            <input type="number" name="ico" class="w-full"  placeholder="IČO organizácie" value="{{ old('ico') ?? $organization->ico }}" maxlength="8" aria-describedby="basic-addon7"/>
        </div>

        {{-- DIČ Field --}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="basic-addon8">DIČ</label>
            <input type="text" name="dic" class="w-full"  placeholder="DIČ dodávateľa" value="{{ old('dic') ?? $organization->dic }}" aria-describedby="basic-addon8"/>
        </div>

        {{-- IC DIČ Field --}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="basic-addon9">IC DIČ</label>
            <input type="text" name="ic_dic" class="w-full"  placeholder="IC DIČ pre plátcov DPH" value="{{ old('ic_dic') ?? $organization->ic_dic }}" aria-describedby="basic-addon9"/>
        </div>



        {{-- Bank account--}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="banka">Názov banky</label>
            <input type="text" name="bank_name" class="w-full"  placeholder="Bankový účet" value="{{ old('bank_name') ?? $organization->bank_name}}" aria-describedby="banka"/>
        </div>

        {{-- Bank No --}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="bankaNo">Číslo účtu</label>
            <input type="text" name="bank_number" class="w-full"  placeholder="Číslo účtu" value="{{ old('bank_number') ?? $organization->bank_number }}" aria-describedby="bankaNo"/>
        </div>

        {{-- IBAN --}}
        <div class="mb-4">
            <label class="flex-shrink-0 input-label" id="bankaNo">IBAN</label>
            <input type="text" name="bank_iban" class="w-full"  placeholder="Iban" value="{{ old('bank_iban') ?? $organization->bank_iban}}" aria-describedby="bankaNo"/>
        </div>

        {{-- Save button --}}
        <div class="">
            <button type="submit" class="w-full btn btn-primary">Uložiť</button>
        </div>

    </div>




</div>


