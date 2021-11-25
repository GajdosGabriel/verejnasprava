<template>
    <Card>
        <card-header
            icon="council"
            title="Nové zastupiteľstvo"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen" class="px-4">
            <FormulateForm @submit="storeCouncil">
                <FormulateInput
                    type="text"
                    label="Názov zastupiteľstva"
                    validation="bail|required"
                    validation-name="Názov zastupiteľstva"
                    placeholder="Názov zastupiteľstva"
                    v-model="council.name"
                />

                <FormulateInput
                    type="text"
                    label="Popis zastupiteľstva"
                    placeholder="Popis zastupiteľstva"
                    v-model="council.description"
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
    data() {
        return {
            council: {
                name: "",
                description: "",
            },
        };
    },
    computed: {
        ...mapState("organizations", ["organization"]),
    },
    methods: {
        storeCouncil: function () {
            this.$store.dispatch("councils/storeCouncil", [
                this.organization.id,
                this.council,
            ]);
        },
    },
};
</script>
