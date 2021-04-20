<template>
    <div>

        <span v-if="$auth.isAdmin()" @click="newContactToggle" class="px-4 text-center text-sm text-gray-500 cursor-pointer">
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
