<template>
    <Modal>
        <form @submit.prevent="updateCouncil">
            <div class="mt-2">
                <div class="md:flex">
                    <!--SITE A -->
                    <div class="w-full">
                        <div class="my-3">
                            <label for="name" class="input-label"
                                >Názov zastupiteľstva</label
                            >

                            <div class="col-md-8">
                                <input
                                    id="name"
                                    type="text"
                                    class="
                                        input-control
                                        focus:outline-none focus:shadow-outline
                                    "
                                    name="name"
                                    v-model="council.name"
                                    required
                                    autocomplete="name"
                                />
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="description" class="input-label"
                                >Popis zastupiteľstva</label
                            >

                            <div class="col-md-8">
                                <input
                                    id="description"
                                    type="text"
                                    class="
                                        input-control
                                        focus:outline-none focus:shadow-outline
                                    "
                                    name="description"
                                    v-model="council.description"
                                    autocomplete="description"
                                />
                            </div>
                        </div>

                        <div class="my-3">
                            <label class="input-label"
                                >Minimálna účasť na zasadnutí je:</label
                            >
                            <div class="max-w-sm">
                                <input
                                    type="radio"
                                    id="min_user1"
                                    name="min_user"
                                    value="50"
                                    v-model="council.min_user"
                                />
                                <label for="min_user1"
                                    >Polovičná z všetkých členov</label
                                ><br />
                                <input
                                    type="radio"
                                    id="min_user2"
                                    name="min_user"
                                    value="75"
                                    v-model="council.min_user"
                                />
                                <label for="min_user2"
                                    >Dvojtretinová z všetkých členov</label
                                ><br />
                            </div>
                        </div>

                        <div class="my-3">
                            <label class="input-label"
                                >Úspešné hlasovanie je:</label
                            >
                            <div class="max-w-sm">
                                <input
                                    type="radio"
                                    id="quorate1"
                                    name="quorate"
                                    value="50"
                                    v-model="council.quorate"
                                />
                                <label for="quorate1"
                                    >Polovičná z prítomných</label
                                ><br />
                                <input
                                    type="radio"
                                    id="quorate2"
                                    name="quorate"
                                    value="75"
                                    v-model="council.quorate"
                                />
                                <label for="quorate2"
                                    >Dvojtretinová z prítomných</label
                                ><br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="
                        inline-flex
                        justify-center
                        w-full
                        rounded-md
                        border border-transparent
                        px-4
                        py-2
                        bg-blue-600
                        text-base
                        leading-6
                        font-medium
                        text-white
                        shadow-sm
                        hover:bg-blue-500
                        focus:outline-none
                        focus:border-blue-700
                        focus:shadow-outline-red
                        transition
                        ease-in-out
                        duration-150
                        sm:text-sm sm:leading-5
                    "
                >
                    Uložiť
                </button>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from "../components/Modals/Modal.vue";
import { mapState } from "vuex";
import { createNamespacedHelpers } from "vuex";

const { mapActions } = createNamespacedHelpers("modals");

export default {
    components: { Modal },
    computed: mapState({
        council: (state) => state.councils.council,
    }),

    methods: {
        updateCouncil() {
            this.$store.dispatch("councils/updateCouncil", this.council);
        },
    },
};
</script>
