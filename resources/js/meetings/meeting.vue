<template>
    <div v-cloak class="">
        <div
            class="flex justify-between border-b-2 border-gray-400 mb-2"
            :class="{ 'border-red-300': !meeting.published }"
        >
            <div class="">
                <span
                    class="text-gray-700 font-semibold"
                    :class="{ 'text-red-700': !meeting.published }"
                    >Začiatok:
                    {{ moment(meeting.start_at).format("DD. MM. YYYY") }}</span
                >
                <span :class="{ 'text-red-700': !meeting.published }"
                    >{{ moment(meeting.start_at).format("H:mm") }} hod.</span
                >
            </div>

            <drop-down-component
                :items="meeting"
                @fromItem="clickOnItem"
            ></drop-down-component>
        </div>

        <div
            v-if="!positionSaveButton"
            class="flex justify-between mb- text-xs mb-6"
        >
            <a
                :href="'/meetings/' + meeting.id + '/file/show'"
                class="
                    border-orange-300
                    bg-orange-100
                    border-2
                    text-gray-600
                    px-1
                    rounded-sm
                    flex
                "
                target="_blank"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>

                Pozvánka
            </a>

            <!--  User-Meeting Presenter -->
            <div v-if="meeting.published">
                <button
                    v-if="isUserPresent"
                    @click="updateMeetingUser"
                    class="
                        border-blue-300
                        bg-blue-100
                        border-2
                        text-gray-600
                        px-1
                        rounded-sm
                    "
                >
                    Prihlásený {{ user.last_name }} ({{ meeting.users.length }})
                </button>

                <button
                    v-else
                    @click="storeMeetingUser"
                    class="
                        border-green-300
                        bg-green-100
                        border-2
                        text-gray-600
                        px-1
                        rounded-sm
                    "
                >
                    Prezentovať sa ({{ meeting.users.length }})
                </button>
            </div>

            <button
                v-if="$auth.can('council delete') && meeting.published"
                @click="resetMeetingUser"
                class="
                    border-red-300
                    bg-red-100
                    border-2
                    text-gray-600
                    px-1
                    rounded-sm
                "
            >
                Nová prezentácia
            </button>
            <!-- End of User-Meeting Presenter -->
        </div>

        <div v-else class="flex justify-between max-w-sm mb- text-xs mb-6">
            <button
                class="bg-blue-600 text-gray-200 px-2 rounded-sm"
                v-if="positionSaveButton"
                @click="savePosition"
            >
                Uložiť zmeny
            </button>

            <button
                class="bg-red-600 text-gray-200 px-2 rounded-sm"
                v-if="positionSaveButton"
                @click="positionSaveButton = !positionSaveButton"
            >
                Zrušiť zmeny
            </button>
        </div>

        <draggable v-model="items" v-if="positionSaveButton">
            <transition-group>
                <div
                    v-for="item in items"
                    :key="item.id"
                    class="odd:bg-gray-500 bg-white"
                >
                    <item-list :item="item"></item-list>
                </div>
            </transition-group>
        </draggable>

        <transition-group v-else>
            <div
                v-for="item in items"
                :key="item.id"
                class="odd:bg-gray-500 bg-white"
            >
                <item-list :item="item"></item-list>
            </div>
        </transition-group>

        <!--   Files-->
        <div class="max-w-sm" v-if="files.length">
            <h5 class="mt-4" style="border-bottom: 2px solid silver">
                Príloha
            </h5>
            <div v-for="(file, index) in files" :key="file.id">
                <a
                    class="mr-2 hover:text-blue-500"
                    target="_blank"
                    :title="file.org_name"
                    :href="
                        '/file/' + file.id + '/' + file.filename + '/file/show'
                    "
                >
                    {{ index + 1 }}. Príloha
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import moment from "moment";
import { mapState } from "vuex";
import itemList from "../items/itemList";
import dropDownComponent from "../components/dropDown/dropDownComponent";

export default {
    props: ["pmeeting"],
    components: { itemList, draggable, dropDownComponent },
    data: function () {
        return {
            moment: require("moment"),
            positionSaveButton: false,
        };
    },
    computed: {
        isUserPresent() {
            return this.meeting.users.filter(
                (value) => value.id == this.user.id
            ).length;
        },
        notificationStatus() {
            return this.meeting.notification == null
                ? "Pozvánka na zasadnutie"
                : moment(this.meeting.notification).format(
                      "DD. MM. YYYY, HH:mm"
                  );
        },
        ...mapState({
            meeting: (state) => state.meetings.meeting,
            files: (state) => state.meetings.files,
        }),

        items: {
            get() {
                return this.$store.state.meetings.items;
            },
            set(value) {
                this.$store.commit("meetings/UPDATE_LIST", value);
            },
        },
    },

    created() {
        this.$store.dispatch(
            "meetings/fetchMeeting",
            "/api/councils/" +
                this.pmeeting.council_id +
                "/meetings/" +
                this.pmeeting.id
        );
    },
    methods: {
        clickOnItem(action, meeting) {
            if (!window.confirm("Skutočne zmazať zasadnutie?")) {
                return;
            }
            if (action == "delete") {
                this.$store.dispatch(
                    "meetings/deleteMeeting",
                    meeting.navigations.delete.url
                );
            }

            if (action == "published") {
                this.$store.dispatch("meetings/updateMeeting", [
                    this.meeting,
                    {
                        published: !this.meeting.published,
                    },
                ]);
            }

            if (action == "orderItem") {
                bus.$emit("closeDropDown", () => {
                    this.isOpen = false;
                });
                this.positionSaveButton = !this.positionSaveButton;
            }
        },
        resetMeetingUser() {
            if (!window.confirm("Skutočne to spraviť?")) {
                return;
            }
            this.$store.dispatch("meetings/deleteMeetingUsers", {
                id: this.meeting.id,
            });
        },
        updateMeetingUser() {
            this.$store.dispatch("meetings/updateMeetingUser", {
                user: this.user.id,
                id: this.meeting.id,
            });
        },

        storeMeetingUser() {
            this.$store.dispatch("meetings/storeMeetingUser", {
                user: this.user.id,
                id: this.meeting.id,
            });
        },

        savePosition() {
            this.items.forEach((item, key) => {
                console.log("Key " + key + " " + item.name);
            });

            let postData = {};
            postData.items = this.items.map((item) => {
                return {
                    id: item.id,
                };
            });

            axios
                .put("/item/position/slug/item/position", postData)
                .then((response) => console.log("response", response));

            this.positionSaveButton = !this.positionSaveButton;
        },
    },
};
</script>
<style>
[v-cloak] {
    display: none;
}
</style>
