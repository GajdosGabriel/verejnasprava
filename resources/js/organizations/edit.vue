<template>

    <div class="md:flex">
        <h3 class="text-lg cursor-pointer" @click="toggle">Firemmné údaje</h3>
        <!-- SITE A -->
        <div class="max-w-sm md:p-4" v-if="show">

            <!-- Title Field-->
            <div class="mb-4">
                <label class="input-label" id="basic-addon1">Firma</label>
                <input type="text" name="name" class="input-control" placeholder="Názov firmy"
                       v-model="organization.name"/>
            </div>

            <!-- Ulica-->
            <div class="mb-4">
                <label class="input-label" id="basic-addon2">Ulica a číslo</label>
                <input type="text" name="street" class="input-control" placeholder="Ulica a číslo"
                       v-model="organization.street"/>
            </div>

            <!-- PSČ-->
            <div class="mb-4">
                <label class="input-label" id="basic-addon3">PSČ</label>
                <input type="number" name="psc" class="input-control" placeholder="Poštové smerové číslo"
                       v-model="organization.psc" aria-describedby="basic-addon3" required/>
            </div>

            <!-- Mesto-->
            <div class="mb-4">
                <label class="input-label" id="basic-addon4">Mesto</label>
                <input type="text" name="city" class="input-control" placeholder="Mesto"
                       v-model="organization.city" aria-describedby="basic-addon4" required/>
            </div>

            <!-- Email-->
            <div class="mb-4">

                <label class="input-label" id="basic-addon5">Email</label>

                <input type="email" name="email" class="input-control" placeholder="Email dodávateľa"
                       v-model="organization.email" aria-describedby="basic-addon5" required/>
            </div>

            <!-- Phone-->
            <div class="mb-4">
                <label class="input-label" id="basic-addon6">Telefón</label>
                <input type="text" name="phone" class="input-control" placeholder="Telefón dodávateľa"
                       v-model="organization.phone" aria-describedby="basic-addon6"/>
            </div>


        </div>

        <!-- SITE B-->
        <div class="max-w-sm md:p-4" v-if="show">
            <!-- ICO Field-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="basic-addon7">IČO</label>
                <input type="number" name="ico" class="input-control" placeholder="IČO organizácie"
                       v-model="organization.ico" maxlength="8" aria-describedby="basic-addon7"/>
            </div>

            <!-- DIČ Field-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="basic-addon8">DIČ</label>
                <input type="text" name="dic" class="input-control" placeholder="DIČ dodávateľa"
                       v-model="organization.dic" aria-describedby="basic-addon8"/>
            </div>

            <!-- IC DIČ Field-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="basic-addon9">IC DIČ</label>
                <input type="text" name="ic_dic" class="input-control" placeholder="IC DIČ pre plátcov DPH"
                       v-model="organization.ic_dic" aria-describedby="basic-addon9"/>
            </div>


            <!-- Bank account-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="banka">Názov banky</label>
                <input type="text" name="bank_name" class="input-control" placeholder="Bankový účet"
                       v-model="organization.bank_name" aria-describedby="banka"/>
            </div>

            <!--  Bank No-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="bankaNo">Číslo účtu</label>
                <input type="text" name="bank_number" class="input-control" placeholder="Číslo účtu"
                       v-model="organization.bank_number" aria-describedby="bankaNo"/>
            </div>

            <!-- IBAN-->
            <div class="mb-4">
                <label class="flex-shrink-0 input-label" id="bank_iban">IBAN</label>
                <input type="text" name="bank_iban" class="input-control" placeholder="Iban"
                       v-model="organization.bank_iban" aria-describedby="bankaNo"/>
            </div>

            <!--  Save button-->
            <div class="">
                <button type="submit" class="w-full btn btn-primary">Uložiť</button>
            </div>

        </div>


    </div>


</template>

<script>
    export default {
        data: function () {
            return {
                show: false
            }
        },
        methods: {
            toggle: function(){
                this.show =! this.show
            }
        }

    }
</script>
