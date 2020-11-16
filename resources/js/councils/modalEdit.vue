<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" v-if="showModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Upraviť
                                </h3>
                                <span @click="open_form" class="cursor-pointer text-gray-500">X</span>
                            </div>

                            <form @submit.prevent="saveContact">
                                <div class="mt-2">
                                    <div class="md:flex">

                                        <!--SITE A -->
                                        <div class="w-full">

                                            <div class="my-3">
                                                <label for="name" class="input-label">Názov zastupiteľstva</label>

                                                <div class="col-md-8">
                                                    <input id="name" type="text"
                                                           class="input-control focus:outline-none focus:shadow-outline"
                                                           name="name"
                                                           v-model="council.name" required autocomplete="name">
                                                </div>
                                            </div>

                                            <div class="my-3">
                                                <label for="description" class="input-label">Popis zastupiteľstva</label>

                                                <div class="col-md-8">
                                                    <input id="description" type="text"
                                                           class="input-control focus:outline-none focus:shadow-outline"
                                                           name="description"
                                                           v-model="council.description" autocomplete="description">

                                                </div>
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
                                @click="open_form">
                            Zrušiť
                        </button>

                        <button type="button"
                                @click="update(council)"
                                class="ml-3 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Uložiť
                        </button>
                    </span>

                    <!--                    <div>-->
                    <!--                    <input type="checkbox" id="delete1" name="deleteContact" value="true">-->
                    <!--                    <label for="delete1"> zmazať kontakt</label>-->
                    <!--                    </div>-->


                    <!--                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">-->
                    <!--                    <button type="button"-->
                    <!--                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-gray-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">-->
                    <!--                        Zmazať-->
                    <!--                    </button>-->
                    <!--                    </span>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import {createNamespacedHelpers} from 'vuex';

    const {mapActions} = createNamespacedHelpers('modals');

    export default {
        computed: mapState({
            showModal: state => state.modals.showModal,
            council: state => state.councils.council
        }),

        methods: {
            update(council){
                this.$store.dispatch('councils/update', council)
            },
            ...mapActions([
                'open_form'
            ])
        }
    }
</script>
