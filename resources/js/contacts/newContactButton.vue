<template>
    <div>

        <span v-if="$auth.isAdmin()" @click="newContactToggle" class="px-4 hover:bg-gray-200 shadow-md border-gray-500 border-2 rounded-md text-center cursor-pointer">
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
