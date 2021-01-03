<template>
    <div>

        <span v-if="$auth.isAdmin()" @click="newContactToggle" class="text-xs cursor-pointer">
            Nový
        </span>

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
