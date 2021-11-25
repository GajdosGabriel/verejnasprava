<template>
    <Card>
        <card-header
            icon="config"
            :title="'Firemnné údaje'"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen" class="px-4">
            <FormulateForm @submit="updateOrg">
                <FormulateInput
                    type="text"
                    label="Firma"
                    validation="bail|required"
                    validation-name="Názov firmy"
                    placeholder="Firma"
                    v-model="organization.name"
                />

                <FormulateInput
                    type="text"
                    label="Ulica a číslo"
                    validation="bail|required"
                    validation-name="Adresa"
                    placeholder="Ulica a číslo"
                    v-model="organization.street"
                />

                <FormulateInput
                    type="text"
                    label="Mesto"
                    validation="bail|required"
                    validation-name="Mesto"
                    placeholder="Mesto"
                    v-model="organization.city"
                />

                <FormulateInput
                    type="text"
                    label="PSČ"
                    validation="bail|required"
                    validation-name="Psč"
                    placeholder="Psč"
                    v-model="organization.psc"
                />

                <FormulateInput
                    type="email"
                    label="Email"
                    validation="bail|email"
                    placeholder="Váš email"
                    v-model="organization.email"
                />

                <FormulateInput
                    type="text"
                    label="Telefón"
                    validation-name="Telefón"
                    placeholder="Telefón"
                    v-model="organization.phone"
                />

                <FormulateInput
                    type="text"
                    label="ICO"
                    validation-name="Ičo"
                    placeholder="Ičo firmy"
                    v-model="organization.ico"
                />

                <FormulateInput
                    type="text"
                    label="DIC"
                    validation-name="DIC"
                    placeholder="Dič firmy"
                    v-model="organization.dic"
                />

                <FormulateInput
                    type="text"
                    label="IC DIC"
                    validation-name="IC DIC"
                    placeholder="IC Dič firmy"
                    v-model="organization.ic_dic"
                />

                <FormulateInput
                    type="text"
                    label="Názov banky"
                    validation-name="Názov banky"
                    placeholder="Názov banky"
                    v-model="organization.bank_name"
                />

                <FormulateInput
                    type="text"
                    label="Číslo účtu"
                    validation-name="Číslo účtu"
                    placeholder="Číslo účtu"
                    v-model="organization.bank_number"
                />

                <FormulateInput
                    type="text"
                    label="IBAN"
                    validation-name="IBAN"
                    placeholder="Iban"
                    v-model="organization.iban"
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

    computed: {
        ...mapState("organizations", ["organization"]),
    },
    methods: {
        updateOrg: function () {
            this.$store.dispatch("organizations/updateOrganization", this.organization);
        },
    },
};
</script>
