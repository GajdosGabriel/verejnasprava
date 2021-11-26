<template>
    <Modal>
        <form @submit.prevent="deleteCouncil">
            <div class="mt-2">
                <div class="">
                    <div class="block">
                    Skutočne vymazať
                    </div>
                    <div class="font-semibold block text-center">
                        {{ council.name }}
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
                        bg-red-600
                        text-base
                        leading-6
                        font-medium
                        text-white
                        shadow-sm
                        hover:bg-red-500
                        focus:outline-none
                        focus:border-red-700
                        focus:shadow-outline-red
                        transition
                        ease-in-out
                        duration-150
                        sm:text-sm sm:leading-5
                    "
                >
                    Zmazať
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
        deleteCouncil() {
            this.$store.dispatch("councils/deleteCouncil", this.council);
        },
    },
};
</script>
