<template>
    <div>

        <button v-if="$auth.isAdmin()" @click="newContactToggle" class="text-sm text-gray-500">
            Nový kontakt
        </button>

        <form-create></form-create>
    </div>
</template>

<script>
    import formCreate from './formCreate.vue';
    import { createNamespacedHelpers } from 'vuex';
    const { mapActions } = createNamespacedHelpers('contacts');

    export default {
        components: {formCreate},

        methods: {
            ...mapActions([
                'newContactToggle'
            ])
        }

    }
</script>
