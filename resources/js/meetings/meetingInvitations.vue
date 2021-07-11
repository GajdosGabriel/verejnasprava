<template>
    <div
        v-if="meeting.published && $auth.can('council delete')"
        class="border-2 rounded-md border-gray-300 mb-12"
    >
        <div
            class="flex justify-between bg-gray-300 p-1 cursor-pointer items-center"
            :class="quorateMeeting"
            @click="openToggle"
        >
            <div class="font-medium text-gray-800">
                <div class="flex cursor-pointer">
                    <svg
                        class="w-4 h-4 mr-1 fill-current my-1 text-gray-600"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M2 6H0v2h2v2h2V8h2V6H4V4H2v2zm7 0a3 3 0 0 1 6 0v2a3 3 0 0 1-6 0V6zm11 9.14A15.93 15.93 0 0 0 12 13c-2.91 0-5.65.78-8 2.14V18h16v-2.86z"
                        />
                    </svg>
                    Pozvánky
                </div>
            </div>

            <span class="text-sm flex">
                ({{ meeting.invitations.length }}/{{ councilUsers.length }})
            </span>

            <svg
                class="-mr-1 ml-2 h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>

        <table v-if="openList" class="bg-white w-full">
            <tr>
                <th class="bg-blue-100 border text-left px-8 py-2">Meno</th>
                <th class="bg-blue-100 border text-left px-8 py-2">Pozvánka</th>
                <th class="bg-blue-100 border text-left px-8 py-2">Účasť</th>
            </tr>
            <tr v-for="councilUser in councilUsers" :key="councilUser.id">
                <td
                    v-text="
                        councilUser.first_name + ' ' + councilUser.last_name
                    "
                    class="border px-4 py-2 cursor-pointer"
                    @click="saveNotification(councilUser.id)"
                ></td>
                <td
                    class="border px-4 py-2"
                    v-text="userInvitationDetails(councilUser)"
                >
                    <!-- {{ moment(userInvitationDetails(councilUser).send_at).format("DD. MM. YYYY, HH:mm") }} -->
                </td>
                <td class="border px-4 py-2 text-xs">
                    <div v-if="userInvitationDetails(councilUser).send_at">
                        <button
                            v-if="
                                userInvitationDetails(councilUser).confirmed_at
                            "
                            class="border-green-300 bg-green-100 border-2 text-gray-600 px-1 rounded-sm"
                        >
                            Potvrdená
                        </button>

                        <button
                            v-else
                            class="border-blue-300 bg-blue-100 border-2 text-gray-600 px-1 rounded-sm"
                        >
                            Nepotvrdená
                        </button>
                    </div>
                </td>
            </tr>
        </table>

        <div class="flex justify-between p-2">
            <button @click="notificationForAllUsers" class="text-xs">
                <div class="flex items-center">
                    <svg
                        class="w-3 h-3 mr-1 fill-current"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"
                        />
                    </svg>
                    Pozvať všetkých ({{ councilUsers.length - sendUsers }})
                </div>
            </button>
            <button class="text-xs">
                <div class="flex items-center">
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
            </button>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import { filterMixin } from "../mixins/filterMixin";
import moment from "moment";
export default {
    mixins: [filterMixin],
    props: {
        councilid: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            openList: true,
            moment: require("moment"),
            invitations: []
        };
    },
    computed: {
        quorateMeeting() {
            var percento =
                (100 * this.meetingUsers.length) / this.councilUsers.length;
            // return percento;
            if (percento > this.council.quorate) {
                return "bg-green-200 ";
            }
            return "bg-blue-300";
        },

        unsendUsers() {
            return this.invitations.filter(o => o.send_at == null).length;
        },

        sendUsers() {
            return this.invitations.filter(o => o.send_at != null).length;
        },

        unconfirmedUsers() {
            return this.invitations.filter(o => o.confirmed_at == null).length;
        },

        ...mapState({
            meetingUsers: state => state.meetings.meetingUsers,
            councilUsers: state => state.meetings.councilUsers,
            council: state => state.meetings.council,
            meeting: state => state.meetings.meeting
        })
    },
    created() {
        this.fetchInvitations();
    },
    methods: {
        openToggle() {
            this.openList = !this.openList;
        },

        fetchInvitations() {
            axios.get("/api/meeting/" + 1 + "/invitation").then(response => {
                this.invitations = response.data;
            });
        },

        saveNotification(user) {
            if (!this.meeting.published) {
                alert(
                    "Zasadnutie nie je publikované. Najprv zapnite publikovanie!"
                );
            }

            axios
                .post("/api/meeting/" + this.meeting.id + "/invitation", {
                    user_id: user
                })
                .then(response => {
                    this.fetchInvitations();
                });
        },

        notificationForAllUsers() {
            if (!this.meeting.published) {
                alert(
                    "Zasadnutie nie je publikované. Najprv zapnite publikovanie!"
                );
            }

            axios
                .post("/api/meeting/" + this.meeting.id + "/invitation", {
                    allUsers: true
                })
                .then(response => {
                    this.fetchInvitations();
                });
        },

        userInvitationDetails(user) {
            if (this.invitations.find(o => o.user_id == user.id)) {
                return moment(
                    this.invitations.find(o => o.user_id == user.id).send_at
                ).format("DD. MM. YYYY HH:mm");
            }
            return '';
        }
    }
};
</script>
