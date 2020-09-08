<template>

    <div :class="typeClass" class="p-3 m-4 rounded border-2 border-green-700 flex justify-between">
        {{ notification.message }}
        <span @click="remove" class="cursor-pointer">x</span>
    </div>
</template>

<script>
    import notification from "../store/modules/notification";

    export default {
        props: ['notification'],

        computed: {
            typeClass: function () {
                return this.notification.type;
            }
        },

        methods: {
            remove: function () {
                this.$store.dispatch('notification/removeNotification', this.notification);
            }
        },
        created: function () {
            setTimeout(() => {
                this.$store.dispatch('notification/removeNotification', this.notification)

            }, 3000)
        }

    }
</script>

