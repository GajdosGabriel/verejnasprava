<div class="row">

    {{--SITE A --}}
    <div class="col-md-6">

        {{-- Title Field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-danger" id="basic-addon1">Firma</span>
            </div>
            <input type="text" name="name" class = "form-control"  placeholder="Názov firmy" value="{{ old('name') ?? $organization->name }}" aria-describedby="basic-addon1"/>
        </div>

        {{-- Ulica --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2">Ulica a číslo</span>
            </div>
            <input type="text" name="street" class = "form-control"  placeholder="Ulica a číslo" value="{{ old('street') ?? $organization->slug}}" aria-describedby="basic-addon2"/>
        </div>

        {{-- PSČ --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-danger" id="basic-addon3">PSČ</span>
            </div>
            <input type="number" name="psc" class = "form-control"  placeholder="Poštové smerové číslo" value="{{ old('psc') ?? $organization->psc }}" aria-describedby="basic-addon3" required/>
        </div>

        {{-- Mesto --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-danger" id="basic-addon4">Mesto</span>
            </div>
            <input type="text" name="city" class = "form-control"  placeholder="Mesto" value="{{ old('city') ?? $organization->city}}" aria-describedby="basic-addon4" required/>
        </div>

        {{-- Email --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-danger" id="basic-addon5">Email</span>
            </div>
            <input type="email" name="email" class = "form-control"  placeholder="Email dodávateľa" value="{{ old('email') ?? $organization->email }}" aria-describedby="basic-addon5" required/>
        </div>

        {{-- Phone --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon6">Telefón</span>
            </div>
            <input type="text" name="phone" class = "form-control"  placeholder="Telefón dodávateľa" value="{{ old('phone') ?? $organization->phone }}" aria-describedby="basic-addon6"/>
        </div>


    </div>

    {{--SITE B --}}
    <div class="col-md-6">
        {{-- ICO Field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-danger" id="basic-addon7">IČO</span>
            </div>
            <input type="number" name="ico" class = "form-control"  placeholder="IČO organizácie" value="{{ old('ico') ?? $organization->ico }}" maxlength="8" aria-describedby="basic-addon7"/>
        </div>

        {{-- DIČ Field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon8">DIČ</span>
            </div>
            <input type="text" name="dic" class = "form-control"  placeholder="DIČ dodávateľa" value="{{ old('dic') ?? $organization->dic }}" aria-describedby="basic-addon8"/>
        </div>

        {{-- IC DIČ Field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon9">IC DIČ</span>
            </div>
            <input type="text" name="ic_dic" class = "form-control"  placeholder="IC DIČ pre plátcov DPH" value="{{ old('ic_dic') ?? $organization->ic_dic }}" aria-describedby="basic-addon9"/>
        </div>


        <h5>Fakturačné údaje</h5>

        {{-- Bank account--}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="banka">Názov banky</span>
            </div>
            <input type="text" name="bank_name" class = "form-control"  placeholder="Bankový účet" value="{{ old('bank_name') ?? $organization->bank_name}}" aria-describedby="banka"/>
        </div>

        {{-- Bank No --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="bankaNo">Číslo účtu</span>
            </div>
            <input type="text" name="bank_number" class = "form-control"  placeholder="Číslo účtu" value="{{ old('bank_number') ?? $organization->bank_number }}" aria-describedby="bankaNo"/>
        </div>

        {{-- IBAN --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="bankaNo">IBAN</span>
            </div>
            <input type="text" name="bank_iban" class = "form-control"  placeholder="Iban" value="{{ old('bank_iban') ?? $organization->bank_iban}}" aria-describedby="bankaNo"/>
        </div>


        {{-- Save button --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">Uložiť</button>
        </div>

    </div>


</div>


