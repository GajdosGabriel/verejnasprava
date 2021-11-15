<template>
    <div>
        <!-- Button show-hide modal Form -->
        <div class="cursor-pointer hover:text-red-700" @click="toggle"
            >Nová nálepka</div
        >
        <!-- Modal Form start -->
        <div class="fixed z-10 inset-0 overflow-y-auto" v-if="showModalForm">
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
            >
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                ></span
                >&#8203;
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="modal-headline"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <!--                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">-->
                            <!--                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
                            <!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />-->
                            <!--                            </svg>-->
                            <!--                        </div>-->
                            <div
                                class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full"
                            >
                                <header class="flex justify-between w-full">
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                        id="modal-headline"
                                        v-text="title"
                                    ></h3>
                                    <span
                                        @click="toggle"
                                        class="cursor-pointer text-gray-500"
                                        >X</span
                                    >
                                </header>

                                <form @submit.prevent="saveTag">
                                    <div class="mt-2">
                                        <div class="md:flex">
                                            <!--   Title Field-->
                                            <div class="mb-4  w-full">
                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="input-control"
                                                    :placeholder="title"
                                                    v-model="form.name"
                                                    required
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse flex justify-between items-center"
                                    >
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            Uložiť
                                        </button>

                                        <button
                                            v-if="
                                                !Object.keys(this.form).length
                                            "
                                            @click="toggle"
                                            class="btn btn-default"
                                        >
                                            Zrušiť
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showModalForm: false,
            form: {
                name: null
            }
        };
    },
    computed: {
        title() {
            return Object.keys(this.form).length ? "Nová nálepka" : "Upraviť tág";
        }
    },
    methods: {
        toggle() {
            this.showModalForm = !this.showModalForm;
        },
        closeModal() {
            this.$emit("emitShowModal", false);
            this.form = {};

        },
        saveTag() {
            axios
                .post(
                    "/api/organizations/" +
                        this.user.active_organization +
                        "/tags",
                    this.form
                )
                .then(
                    res => {
                        this.$emit("addNewTag", res.data);
                    },

                    (this.form = {})
                );
            this.toggle();
        }
    }
};
</script>
