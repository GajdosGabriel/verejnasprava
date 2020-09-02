<template>

<!--    <div class="md:w-1/2 sm:w-full hover:bg-gray-200 p-2 rounded-sm  cursor-pointer">-->

<!--        <div class="flex justify-between items-center"  @click="toggle">-->

<!--            <h3 class="fill-current text-lg">Firemnné údaje</h3>-->

<!--            <svg v-if="show" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">-->
<!--                <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>-->
<!--            </svg>-->

<!--            <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">-->
<!--                <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>-->
<!--            </svg>-->

<!--        </div>-->

<!--        <form method="POST" @submit.prevent>-->
<!--            &lt;!&ndash; SITE A &ndash;&gt;-->
<!--            <div class="sm:w-full md:p-4" v-if="show">-->

<!--                &lt;!&ndash; Title Field&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="input-label" id="basic-addon1">Firma</label>-->
<!--                    <input type="text" name="name" class="input-control" placeholder="Názov firmy"-->
<!--                           v-model="organization.name" required/>-->
<!--                </div>-->

<!--                &lt;!&ndash; Ulica&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="input-label" id="basic-addon2">Ulica a číslo</label>-->
<!--                    <input type="text" name="street" class="input-control" placeholder="Ulica a číslo"-->
<!--                           v-model="organization.street" required/>-->
<!--                </div>-->

<!--                &lt;!&ndash; PSČ&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="input-label" id="basic-addon3">PSČ</label>-->
<!--                    <input type="number" name="psc" class="input-control" placeholder="Poštové smerové číslo"-->
<!--                           v-model="organization.psc" aria-describedby="basic-addon3" required/>-->
<!--                </div>-->

<!--                &lt;!&ndash; Mesto&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="input-label" id="basic-addon4">Mesto</label>-->
<!--                    <input type="text" name="city" class="input-control" placeholder="Mesto"-->
<!--                           v-model="organization.city" aria-describedby="basic-addon4" required/>-->
<!--                </div>-->

<!--                &lt;!&ndash; Email&ndash;&gt;-->
<!--                <div class="mb-4">-->

<!--                    <label class="input-label" id="basic-addon5">Email</label>-->

<!--                    <input type="email" name="email" class="input-control" placeholder="Email dodávateľa"-->
<!--                           v-model="organization.email" aria-describedby="basic-addon5" required/>-->
<!--                </div>-->

<!--                &lt;!&ndash; Phone&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="input-label" id="basic-addon6">Telefón</label>-->
<!--                    <input type="text" name="phone" class="input-control" placeholder="Telefón dodávateľa"-->
<!--                           v-model="organization.phone" aria-describedby="basic-addon6"/>-->
<!--                </div>-->


<!--            </div>-->

<!--            &lt;!&ndash; SITE B&ndash;&gt;-->
<!--            <div class="sm:w-full md:p-4" v-if="show">-->
<!--                &lt;!&ndash; ICO Field&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="basic-addon7">IČO</label>-->
<!--                    <input type="number" name="ico" class="input-control" placeholder="IČO organizácie"-->
<!--                           v-model="organization.ico" maxlength="8" aria-describedby="basic-addon7"/>-->
<!--                </div>-->

<!--                &lt;!&ndash; DIČ Field&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="basic-addon8">DIČ</label>-->
<!--                    <input type="text" name="dic" class="input-control" placeholder="DIČ dodávateľa"-->
<!--                           v-model="organization.dic" aria-describedby="basic-addon8"/>-->
<!--                </div>-->

<!--                &lt;!&ndash; IC DIČ Field&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="basic-addon9">IC DIČ</label>-->
<!--                    <input type="text" name="ic_dic" class="input-control" placeholder="IC DIČ pre plátcov DPH"-->
<!--                           v-model="organization.ic_dic" aria-describedby="basic-addon9"/>-->
<!--                </div>-->


<!--                &lt;!&ndash; Bank account&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="banka">Názov banky</label>-->
<!--                    <input type="text" name="bank_name" class="input-control" placeholder="Bankový účet"-->
<!--                           v-model="organization.bank_name" aria-describedby="banka"/>-->
<!--                </div>-->

<!--                &lt;!&ndash;  Bank No&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="bankaNo">Číslo účtu</label>-->
<!--                    <input type="text" name="bank_number" class="input-control" placeholder="Číslo účtu"-->
<!--                           v-model="organization.bank_number" aria-describedby="bankaNo"/>-->
<!--                </div>-->

<!--                &lt;!&ndash; IBAN&ndash;&gt;-->
<!--                <div class="mb-4">-->
<!--                    <label class="flex-shrink-0 input-label" id="bank_iban">IBAN</label>-->
<!--                    <input type="text" name="bank_iban" class="input-control" placeholder="Iban"-->
<!--                           v-model="organization.bank_iban" aria-describedby="bankaNo"/>-->
<!--                </div>-->

<!--                &lt;!&ndash;  Save button&ndash;&gt;-->
<!--                <div class="">-->
<!--                    <button type="submit" class="w-full btn btn-primary">Uložiť</button>-->
<!--                </div>-->

<!--            </div>-->
<!--        </form>-->

<!--    </div>-->


</template>

<script>
    export default {
        data: function () {
            return {
                show: false,
                organization: this.user.organization
            }
        },
        methods: {
            toggle: function () {
                this.show = !this.show
            }
        }

    }
</script>
