<template>
    <div class="flex justify-between p-2" v-if="$auth.isAdmin()">
        <div @click="notificationForAllUsers" class="text-xs">
            <div class="flex items-center cursor-pointer" v-if="unsendUsers">
                <svg
                    class="w-3 h-3 mr-1 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"
                    />
                </svg>
                <transition name="fade">
                    <span>Pozvať všetkých ({{ unsendUsers }})</span>
                </transition>
            </div>
        </div>
        <div class="text-xs">
            <div
                class="flex items-center cursor-pointer"
                v-if="unconfirmedUsers"
            >
                <svg
                    class="w-3 h-3 mr-1 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"
                    />
                </svg>
                Nepotvrdeným ({{ unconfirmedUsers }})
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        unsendUsers() {
            return this.meeting.council_users.length - this.sendUsers;
        },

        sendUsers() {
            return this.meeting.invitations.length;
        },

        unconfirmedUsers() {
            return (
                this.meeting.council_users.length -
                this.meeting.invitations.filter((o) => o.confirmed_at != null)
                    .length
            );
        },

        ...mapState({
            meeting: (state) => state.meetings.meeting,
        }),
    },
    methods: {
        checkIfMeetingPublished() {
            if (!this.meeting.published) {
                return alert(
                    "Zasadnutie nie je publikované. Najprv zapnite publikovanie!"
                );
            }
        },

        notificationForAllUsers() {
            this.checkIfMeetingPublished();

            // Only admin can send invitation
            if (!this.$auth.isAdmin()) {
                return;
            }

            if (this.sendUsers == this.meeting.council_users) {
                alert(
                    "Všetci už poli pozvaný. Na zopakovanie pozvania kliknite na konkrétne mená!"
                );
            }

            axios
                .post("/api/meetings/" + this.meeting.id + "/invitations", {
                    allUsers: true,
                })
                .then((response) => {
                    this.$store.dispatch(
                        "meetings/fetchMeeting",
                        "/api/councils/" +
                            this.meeting.council_id +
                            "/meetings/" +
                            this.meeting.id
                    );
                });
        },
    },
};
</script>
