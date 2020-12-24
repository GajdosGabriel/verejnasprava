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
                        <!--                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">-->
                        <!--                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
                        <!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />-->
                        <!--                            </svg>-->
                        <!--                        </div>-->
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <header class="flex justify-between w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                    Správa od
                                </h3>
                                <span @click="closeModal" class="cursor-pointer text-gray-500">X</span>
                            </header>

                            <form @submit.prevent="saveReading">
                                <div class="mt-2">
                                    <div class="flex flex-col">
                                        <div class="mb-4  w-full">{{ message.name }}</div>
                                        <div class="mb-4  w-full" v-html="message.body"></div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse flex justify-between items-center">
                                    <button type="submit" :disabled="message.pivot.opened !== null"
                                            class="btn btn-primary">
                                        {{ message.pivot.opened == null ? 'Beriem a vedomie' : 'Potvrdené'}}
                                    </button>

                                    <button
                                        @click="closeModal"
                                        class="btn btn-default">
                                        Späť
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['showModal', 'message'],
        data() {
            return {
            }
        },
        methods: {
            closeModal(){
                this.$emit('emitShowModal', false)
            },
            saveReading() {
                axios.put('/messengers/' + this.message.id, this.form)
                .then(
                    (res) => {
                        // this.$emit('addNewTag', res.data)
                    },
                    this.closeModal()
                );
            }

        }
    }
</script>
