<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" v-if="showModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!--                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">-->
                        <!--                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
                        <!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />-->
                        <!--                            </svg>-->
                        <!--                        </div>-->
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <div class="flex justify-between">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Upraviť - {{contact.name }}
                                </h3>
                                <span @click="openEditForm" class="cursor-pointer text-gray-500">X</span>
                            </div>
                            <ul>
                                <li class="bg-red-500 text-red-200 font-semibold my-2 px-2 rounded-sm" v-for="error in errors">{{ error[0] }}</li>
                            </ul>

                            <form @submit.prevent="saveContact">
                                <div class="mt-2">
                                    <div class="md:flex">

                                        <!--SITE A -->
                                        <div class="max-w-sm">
                                            <!--   Title Field-->
                                            <div class="mb-4">
                                                <label class="input-label" id="basic-addon1">Firma</label>
                                                <input type="text" name="name" class="input-control"
                                                       placeholder="Názov firmy" v-model="contact.name" required/>
                                            </div>

                                            <!-- Ulica -->
                                            <div class="mb-4">
                                                <label class="input-label" id="basic-addon2">Ulica a číslo</label>
                                                <input type="text" name="street" class="input-control"
                                                       placeholder="Ulica a číslo" v-model="contact.street"/>
                                            </div>

                                            <!-- PSČ -->
                                            <div class="mb-4">
                                                <label class="input-label" id="basic-addon3">PSČ</label>
                                                <input type="number" name="psc" class="input-control"
                                                       placeholder="Poštové smerové číslo" v-model="contact.psc"
                                                       aria-describedby="basic-addon3" required/>
                                            </div>

                                            <!-- Mesto -->
                                            <div class="mb-4">
                                                <label class="input-label" id="basic-addon4">Mesto</label>
                                                <input type="text" name="city" class="input-control" placeholder="Mesto"
                                                       v-model="contact.city" aria-describedby="basic-addon4" required/>
                                            </div>

                                            <!-- Email -->
                                            <div class="mb-4">

                                                <label class="input-label" id="basic-addon5">Email</label>

                                                <input type="email" name="email" class="input-control"
                                                       placeholder="Email dodávateľa" v-model="contact.email"
                                                       aria-describedby="basic-addon5" required/>
                                            </div>

                                            <!-- Phone -->
                                            <div class="mb-4">
                                                <label class="input-label" id="basic-addon6">Telefón</label>
                                                <input type="text" name="phone" class="input-control"
                                                       placeholder="Telefón dodávateľa" v-model="contact.phone"
                                                       aria-describedby="basic-addon6"/>
                                            </div>

                                        </div>

                                        <!--SITE B -->
                                        <div class="max-w-sm md:px-4">
                                            <!-- ICO Field -->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="basic-addon7">IČO</label>
                                                <input type="number" name="ico" class="input-control"
                                                       placeholder="IČO organizácie" v-model="contact.ico" maxlength="8"
                                                       aria-describedby="basic-addon7"/>
                                            </div>

                                            <!-- DIČ Field -->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="basic-addon8">DIČ</label>
                                                <input type="text" name="dic" class="input-control"
                                                       placeholder="DIČ dodávateľa" v-model="contact.dic"
                                                       aria-describedby="basic-addon8"/>
                                            </div>

                                            <!-- IC DIČ Field -->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="basic-addon9">IC
                                                    DIČ</label>
                                                <input type="text" name="ic_dic" class="input-control"
                                                       placeholder="IC DIČ pre plátcov DPH" v-model="contact.ic_dic"
                                                       aria-describedby="basic-addon9"/>
                                            </div>


                                            <!-- Bank account-->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="banka">Názov banky</label>
                                                <input type="text" name="bank_name" class="input-control"
                                                       placeholder="Bankový účet" v-model="contact.bank_name"
                                                       aria-describedby="banka"/>
                                            </div>

                                            <!-- Bank No -->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="bankaNo">Číslo účtu</label>
                                                <input type="text" name="bank_number" class="input-control"
                                                       placeholder="Číslo účtu" v-model="contact.bank_number"
                                                       aria-describedby="bankaNo"/>
                                            </div>

                                            <!-- IBAN -->
                                            <div class="mb-4">
                                                <label class="flex-shrink-0 input-label" id="bank_iban">IBAN</label>
                                                <input type="text" name="bank_iban" class="input-control"
                                                       placeholder="Iban"
                                                       v-model="contact.bank_iban" aria-describedby="bank_iban"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse flex justify-between items-center">

                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">

                        <button type="submit"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                @click="openEditForm">
                            Zrušiť
                        </button>

                        <button type="button"
                            @click="updateContact(contact)"
                            class="ml-3 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Uložiť
                        </button>
                    </span>

<!--                    <div>-->
<!--                    <input type="checkbox" id="delete1" name="deleteContact" value="true">-->
<!--                    <label for="delete1"> zmazať kontakt</label>-->
<!--                    </div>-->


                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button type="button"
                            @click="deleteContact(contact.id)"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Zmazať
                    </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import {createNamespacedHelpers} from 'vuex';

    const {mapActions} = createNamespacedHelpers('contacts');

    export default {
        computed: mapState({
            showModal: state => state.contacts.showEditForm,
            contact: state => state.contacts.contact,
            errors: state => state.contacts.errors
        }),

        methods: {
            ...mapActions([
                'openEditForm',
                'deleteContact',
                'updateContact'
            ])
        }
    }
</script>
