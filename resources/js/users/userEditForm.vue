<template>
    <Card>
        <card-header
            icon="user"
            :title="'Osobné údaje'"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen" class="px-4">
            <FormulateForm @submit="update">
                <FormulateInput
                    type="text"
                    input-class="w-full"
                    label="Meno"
                    validation="bail|required"
                    validation-name="Meno"
                    placeholder="Meno"
                    v-model="user.first_name"
                />

                <FormulateInput
                    type="text"
                    input-class="w-full"
                    label="Priezvisko"
                    validation="bail|required"
                    validation-name="Priezvisko"
                    placeholder="Priezvisko"
                    v-model="user.last_name"
                />

                <FormulateInput
                    type="email"
                    input-class="w-full"
                    label="Email"
                    validation="bail|required|email"
                    validation-name="Email"
                    placeholder="Váš email"
                    v-model="user.email"
                />

                <FormulateInput
                    type="submit"
                    label="Uložiť"
                    class="btn btn-primary mt-4 text-center"
                />
            </FormulateForm>
        </div>
    </Card>
</template>

<script>
import Card from "../components/Cards/Card.vue";
import cardHeader from "../components/Cards/CardHeader.vue";
import { createdMixin } from "../mixins/createdMixin";
import { mapState } from "vuex";
export default {
    components: { cardHeader, Card },
    mixins: [createdMixin],
    computed: {
        ...mapState("organizations", ["user"]),
    },
    methods: {
        update: function () {
            this.$store.dispatch("users/updateUser", this.user);
        },
    },
};
</script>
