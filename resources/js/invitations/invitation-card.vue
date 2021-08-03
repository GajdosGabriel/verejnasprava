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
                    <span v-text="titleToggle"></span>
                </div>
            </div>

            <span class="text-sm flex">
                ({{ sendUsers }}/{{ councilUsers.length }})
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
        <transition name="fade">
            <table v-if="openList" class="bg-white w-full">
                <tr>
                    <th class="bg-blue-100 border text-left px-8 py-2">Meno</th>
                    <th
                        class="bg-blue-100 border text-left px-8 py-2"
                        v-if="$auth.isAdmin()"
                    >
                        Pozvánka
                    </th>
                    <th class="bg-blue-100 border text-left px-8 py-2">
                        Účasť
                    </th>
                </tr>
                <tr v-for="councilUser in councilUsers" :key="councilUser.id">
                    <td
                        v-text="
                            councilUser.first_name + ' ' + councilUser.last_name
                        "
                        class="border px-4 py-2"
                    ></td>

                    <!-- Pozvánka -->
                    <td
                        v-if="$auth.isAdmin()"
                        class="border px-4 py-2 cursor-pointer"
                        @click="updateInvitation(councilUser)"
                        v-text="invitationDetails(councilUser).send_at"
                    ></td>

                    <!--Učasť -->
                    <td class="border px-4 py-2 text-xs">
                        <div v-if="invitationDetails(councilUser).send_at">
                            <!-- {{ invitationDetails(councilUser).confirmed_at }} -->
                            <div
                                v-if="
                                    invitationDetails(councilUser).send_at !=
                                        'Odoslať'
                                "
                                @click="
                                    saveConfirmation(
                                        invitationDetails(councilUser)
                                            .invitation_id
                                    )
                                "
                                v-text="
                                    invitationDetails(councilUser)
                                        .confirmed_title
                                "
                                class="border-green-300 bg-green-100 border-2 text-gray-600 px-1 rounded-sm text-center"
                                :class="
                                    invitationDetails(councilUser)
                                        .confirmed_title_class +
                                        ' ' +
                                        invitationDetails(councilUser).owner
                                "
                            >
                                <!-- Potvrdená or Nepotvrdená -->
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </transition>
        <invitation-card-admin-panel></invitation-card-admin-panel>
    </div>
</template>

<script>
import { mapState } from "vuex";
import { filterMixin } from "../mixins/filterMixin";
import moment from "moment";
import invitationCardAdminPanel from "./invitation-card-admin-panel.vue";
export default {
    mixins: [filterMixin],
    components: { invitationCardAdminPanel },
    props: {
        meeting_id: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            openList: true,
            moment: require("moment")
        };
    },
    computed: {
        titleToggle() {
            if (this.sendUsers == this.councilUsers.length) {
                return "Potvrdené";
            }

            return "Pozvánky";
        },

        sendUsers() {
            return this.meeting.invitations.length;
        },

        quorateMeeting() {
            var percento =
                (100 * this.meetingUsers.length) / this.councilUsers.length;
            // return percento;
            if (percento > this.council.quorate) {
                return "bg-green-200 ";
            }
            return "bg-blue-300";
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
            this.$store.dispatch("meetings/fetchMeeting", this.meeting_id);
        },

        checkIfMeetingPublished() {
            if (!this.meeting.published) {
                return alert(
                    "Zasadnutie nie je publikované. Najprv zapnite publikovanie!"
                );
            }
        },

        updateInvitation(user) {
            this.checkIfMeetingPublished();

            // Only admin can send invitation
            if (!this.$auth.isAdmin()) {
                return;
            }

            axios
                .put(
                    "/api/meetings/" +
                        this.meeting.id +
                        "/invitation/" +
                        user.id,
                    {
                        user_id: user.id
                    }
                )
                .then(response => {
                    this.fetchInvitations();
                });
        },

        saveConfirmation(invitation_id) {
            this.checkIfMeetingPublished();

            // Only admin can send invitation
            if (!this.$auth.isAdmin()) {
                return;
            }

            axios
                .put("/api/invitations/" + invitation_id, {
                    confirmed_at: new Date()
                        .toISOString()
                        .slice(0, 19)
                        .replace("T", " ")
                })
                .then(response => {
                    this.fetchInvitations();
                });
        },

        invitationDetails(user) {
            var details = {
                send_at: "Odoslať",
                confirmed_at: null
            };
            if (
                (user = this.meeting.invitations.find(
                    o => o.user_id == user.id
                ))
            ) {
                return (details = {
                    invitation_id: user.id,
                    owner: this.$auth.isOwner(user.user_id)
                        ? "cursor-pointer"
                        : "",
                    user_id: user.user_id,
                    meeting_id: user.meeting_id,
                    send_at: moment(user.send_at).format("DD. MM. YYYY HH:mm"),
                    confirmed_at: user.confirmed_at,
                    confirmed_title: user.confirmed_at
                        ? "Potvrdená"
                        : "Nepotvrdená",
                    confirmed_title_class: user.confirmed_at
                        ? ""
                        : "border-blue-300 bg-blue-100 border-2"
                });
            }
            return details;
        }
    }
};
</script>
