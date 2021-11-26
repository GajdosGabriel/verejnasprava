<template>
    <Modal
        title="Zmazať"
        description="Skutočne vymazať"
        :item="item"
        @clickDeleteItem="deleteItem"
    />
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
