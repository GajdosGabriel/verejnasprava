<template>
    <div>
        <a
            v-if="userAdmin"
            @click="newContactToggle"
            class="hover:underline hover:text-gray-900 cursor-pointer"
        >
            Nový kontakt
        </a>

        <form-create></form-create>
    </div>
</template>

<script>
import formCreate from "./formCreate.vue";
import { mapGetters } from "vuex";
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("contacts");

export default {
    components: { formCreate },
    computed: {
        ...mapGetters("organizations", ["userAdmin"])
    },
    methods: {
        ...mapActions(["newContactToggle"])
    }
};
</script>
