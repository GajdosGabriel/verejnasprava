<div class="col-md-6">

    {{-- First Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Meno</span>
        </div>
        <input type="text" name="first_name" class = "form-control"  placeholder="Meno" value="{{ old('first_name') }}" aria-describedby="basic-addon1"/>
    </div>


    {{-- Last Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon2">Priezvisko</span>
        </div>
        <input type="text" name="last_name" class = "form-control"  placeholder="Priezvisko" value="{{ old('last_name') }}" aria-describedby="basic-addon1"/>
    </div>

    {{-- Email Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Email</span>
        </div>
        <input type="text" name="email" class = "form-control"  placeholder="Email" value="{{ old('email') }}" aria-describedby="basic-addon3"/>
    </div>

    {{-- Position Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon4">Pozícia</span>
        </div>
        <input type="text" name="position" class = "form-control"  placeholder="Pracovná pozícia" value="{{ old('position') }}" aria-describedby="basic-addon4"/>
    </div>


    {{-- Street Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon5">Ulica</span>
        </div>
        <input type="text" name="street" class = "form-control"  placeholder="Ulica a číslo" value="{{ old('street') }}" aria-describedby="basic-addon5"/>
    </div>


    {{-- PSČ Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon6">PSČ</span>
        </div>
        <input type="text" name="psc" class = "form-control"  placeholder="Psč" value="{{ old('psc') }}" aria-describedby="basic-addon6"/>
    </div>

    {{-- City Name --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon7">Mesto</span>
        </div>
        <input type="text" name="city" class = "form-control"  placeholder="Mesto" value="{{ old('city') }}" aria-describedby="basic-addon7"/>
    </div>


    {{-- Dátum nástupu --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon8">Dátum nástupu</span>
        </div>
        <input type="date" name="date_contract" class = "form-control"  placeholder="Dátum nástupu zamestnanca" value="{{ old('date_contract') }}" aria-describedby="basic-addon8"/>
    </div>

    {{-- Dátum narodenia --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon9">Dátum narodenia</span>
        </div>
        <input type="date" name="date_born" class = "form-control"  placeholder="Dátum narodenia zamestnanca" value="{{ old('date_born') }}" aria-describedby="basic-addon9"/>
    </div>

    {{-- Phone --}}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon10">Telefón</span>
        </div>
        <input type="text" name="phone" class = "form-control"  placeholder="Telefónny kontakt" value="{{ old('phone') }}" aria-describedby="basic-addon10"/>
    </div>


{{-- Save Button --}}
<div class="form-group">
    <button class="btn btn-primary">Uložiť</button>
</div>

</div>



@section('script')
    <script>
        $(document).ready(function(){

            $('#toggle').hide();
            $('#novyzamestnanec').click(function(){
                $('#toggle').slideToggle();
            });


        });
    </script>

@endsection