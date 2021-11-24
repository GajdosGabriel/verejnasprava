<template>
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

        <FormulateInput type="submit" label="Uložiť" class="btn btn-primary mt-4" />
    </FormulateForm>
</template>

<script>
import { mapState } from "vuex";
export default {
    data: function () {
        return {
           
        };
    },
    computed: {
        ...mapState("organizations", ["user"]),
    },
    methods: {
        update: function () {
            axios.patch("/api/users/" + this.user.id + "/", this.user);
        },
    },
};
</script>
