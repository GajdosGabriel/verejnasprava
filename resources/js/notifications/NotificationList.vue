<template>

    <div class="notification-list">
<!--        <transition name="fade">-->
            <notification-item v-for="notification in notifications" :key="notification.id"
                               :notification="notification"></notification-item>
<!--        </transition>-->
    </div>

</template>

<script>
    import notificationItem from '../notifications/NotificationItem';
    import {mapState} from "vuex";

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

    .fade-enter-active, .fade-leave-active {
        transition: opacity .6s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
