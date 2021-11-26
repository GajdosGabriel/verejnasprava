<template>
    <Modal title="Zmazať" description="Skutočne vymazať" :item="item">
        

        <div>
            <button
                type="submit"
                @click="deleteItem"
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
        item: (state) => state.councils.council,
    }),

    methods: {
        deleteItem() {
            this.$store.dispatch("councils/deleteCouncil", this.item);
        },
    },
};
</script>
