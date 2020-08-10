<template>

    <div class="notification-list">
        <notification-item v-for="notification in notifications" :key="notification.id" :notification="notification" ></notification-item>
    </div>

</template>

<script>
    import notificationItem from '../notifications/NotificationItem';
    import { mapState } from "vuex";

    export default {
        components: {notificationItem},

        // computed: mapState(["notifications"])

        computed: {
            notifications: function () {
                return this.$store.state.notification.notifications
            }
        }

    }
</script>

<style>
    .notification-list {
        position: fixed;
        bottom: 0;
        right: 0;
        margin-right: 15px;
        width: 320px;
    }
</style>
