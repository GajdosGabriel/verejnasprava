<template>
    <div>

        <a v-if="$auth.isAdmin()" @click="newContactToggle" class="hover:underline hover:text-gray-900 cursor-pointer">
            Nový kontakt
        </a>

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
