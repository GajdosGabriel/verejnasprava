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

            <nav-drop-down v-if="$auth.can('council delete')">
                <slot>
                    <div class="py-1">
                        <a
                            class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                            :href="'/meetings/' + meeting.id + '/items/create'"
                            title="Vytvoriť nové zasadnutie"
                        >
                            <div class="flex">
                                <svg
                                    class="w-4 h-4 mr-2 fill-current"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"
                                    />
                                </svg>
                                Nový návrh
                            </div>
                        </a>
                    </div>

                    <!-- Meeting published button-->
                    <a
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                        href="#"
                        title="Zmazať položku"
                    >
                        <div
                            v-if="meeting.published"
                            @click="publishedMeeting(!meeting.published)"
                            class="flex"
                        >
                            <svg
                                class="w-4 h-4 mr-2 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M12.81 4.36l-1.77 1.78a4 4 0 0 0-4.9 4.9l-2.76 2.75C2.06 12.79.96 11.49.2 10a11 11 0 0 1 12.6-5.64zm3.8 1.85c1.33 1 2.43 2.3 3.2 3.79a11 11 0 0 1-12.62 5.64l1.77-1.78a4 4 0 0 0 4.9-4.9l2.76-2.75zm-.25-3.99l1.42 1.42L3.64 17.78l-1.42-1.42L16.36 2.22z"
                                />
                            </svg>
                            Zastaviť publikovanie
                        </div>
                        <div
                            v-else
                            class="flex"
                            @click="publishedMeeting(1)"
                            :class="{ 'text-red-700': !meeting.published }"
                        >
                            <svg
                                class="w-4 h-4 mr-2 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                                />
                            </svg>
                            Publikovať zasadnutie
                        </div>
                    </a>

                    <!-- Meeting Edit button-->
                    <a
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                        :href="'/meetings/' + meeting.id + '/edit'"
                        title="Zmazať položku"
                    >
                        <div class="flex">
                            <svg
                                class="w-4 h-4 mr-2 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"
                                />
                            </svg>
                            Upraviť zasadnutie
                        </div>
                    </a>

                    <!--  Position save button -->
                    <a
                        class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                        href="#"
                        title="Notifikácia pre voliteľov"
                    >
                        <div class="flex" @click="changeOrderItems">
                            <svg
                                class="w-4 h-4 mr-2 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M1 4h2v2H1V4zm4 0h14v2H5V4zM1 9h2v2H1V9zm4 0h14v2H5V9zm-4 5h2v2H1v-2zm4 0h14v2H5v-2z"
                                />
                            </svg>
                            <span>Zmeniť poradie</span>
                        </div>
                    </a>

                    <!-- Meeting Delete button-->
                    <div
                        @click="deleteMeeting(meeting)"
                        class="cursor-pointer block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                        :href="
                            '/meet/' +
                                meeting.id +
                                '/' +
                                meeting.slug +
                                '/meeting/delete'
                        "
                        title="Zmazať položku"
                    >
                        <div class="flex">
                            <svg
                                class="w-4 h-4 mr-2 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"
                                />
                            </svg>
                            Odstrániť
                        </div>
                    </div>
                </slot>
            </nav-drop-down>
        </div>

        <div
            v-if="!positionSaveButton"
            class="flex justify-between mb- text-xs mb-6"
        >
            <a
                :href="'/meetings/' + meeting.id + '/file/show'"
                class="border-orange-300 bg-orange-100 border-2 text-gray-600 px-1 rounded-sm flex"
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
                    class="border-blue-300 bg-blue-100 border-2 text-gray-600 px-1 rounded-sm"
                >
                    Prihlásený {{ user.last_name }} ({{ meeting.users.length }})
                </button>

                <button
                    v-else
                    @click="storeMeetingUser"
                    class="border-green-300 bg-green-100 border-2 text-gray-600 px-1 rounded-sm"
                >
                    Prezentovať sa ({{ meeting.users.length }})
                </button>
            </div>

            <button
                v-if="$auth.can('council delete') && meeting.published"
                @click="resetMeetingUser"
                class="border-red-300 bg-red-100 border-2 text-gray-600 px-1 rounded-sm"
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
                    class="mr-2 hover:text-blue-500 "
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
import navDropDown from "../modules/navigation/navDropDown";
import { mapState } from "vuex";
import itemList from "../items/itemList";
import { bus } from "../app";

export default {
    props: ["pmeeting"],
    components: { itemList, navDropDown, draggable },
    data: function() {
        return {
            moment: require("moment"),
            positionSaveButton: false
        };
    },
    computed: {
        isUserPresent() {
            return this.meeting.users.filter(value => value.id == this.user.id)
                .length;
        },
        notificationStatus() {
            return this.meeting.notification == null
                ? "Pozvánka na zasadnutie"
                : moment(this.meeting.notification).format(
                      "DD. MM. YYYY, HH:mm"
                  );
        },
        ...mapState({
            meeting: state => state.meetings.meeting,
            files: state => state.meetings.files
        }),

        items: {
            get() {
                return this.$store.state.meetings.items;
            },
            set(value) {
                this.$store.commit("meetings/UPDATE_LIST", value);
            }
        }
    },

    created() {
        this.$store.dispatch("meetings/fetchMeeting", this.pmeeting.id);
    },
    methods: {
        changeOrderItems() {
            bus.$emit("closeDropDown", () => {
                this.isOpen = false;
            });
            this.positionSaveButton = !this.positionSaveButton;
        },
        resetMeetingUser() {
            this.$store.dispatch("meetings/deleteMeetingUsers", {
                id: this.meeting.id
            });
        },
        updateMeetingUser() {
            this.$store.dispatch("meetings/updateMeetingUser", {
                user: this.user.id,
                id: this.meeting.id
            });
        },

        storeMeetingUser() {
            this.$store.dispatch("meetings/storeMeetingUser", {
                user: this.user.id,
                id: this.meeting.id
            });
        },

        deleteMeeting(meeting) {
            axios.delete("/meetings/" + meeting.id).then(
                // window.location.reload();
                (window.location.href = "/zastupitelstva")
            );
        },
        publishedMeeting: function(published) {
            this.$store.dispatch("meetings/update", {
                published: published,
                id: this.meeting.id
            });
        },

        savePosition() {
            this.items.forEach((item, key) => {
                console.log("Key " + key + " " + item.name);
            });

            let postData = {};
            postData.items = this.items.map(item => {
                return {
                    id: item.id
                };
            });

            axios
                .put("/item/position/slug/item/position", postData)
                .then(response => console.log("response", response));

            this.positionSaveButton = !this.positionSaveButton;
        }
    }
};
</script>
<style>
[v-cloak] {
    display: none;
}
</style>
