<template>
    <Card>
        <card-header
            icon="user"
            :title="'Osobné nastavenia'"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen" class="px-4">
            <FormulateForm @submit="update">
                <FormulateInput
                    type="text"
                    label="Meno"
                    validation="bail|required"
                    validation-name="Meno"
                    placeholder="Meno"
                    v-model="user.first_name"
                />

                <FormulateInput
                    type="text"
                    label="Priezvisko"
                    validation="bail|required"
                    validation-name="Priezvisko"
                    placeholder="Priezvisko"
                    v-model="user.last_name"
                />

                <FormulateInput
                    type="email"
                    label="Email"
                    validation="bail|required|email"
                    validation-name="Email"
                    placeholder="Váš email"
                    v-model="user.email"
                />

                <FormulateInput
                    type="submit"
                    label="Uložiť"
                    class="btn btn-primary mt-4"
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
    data: function () {
        return {
            isOpen: false,
        };
    },
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
