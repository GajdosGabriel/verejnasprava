<template>
    <div class="border-gray-300" v-if="isPublished">
        <div
            class="flex flex-wrap border-2 mb-4"
            :class="{
                'border-red-300': !item.published,
                'border-green-500': item.result,
                'border-blue-500 rounded-sm': item.vote_status == 1,
            }"
        >
            <div
                class="border-b-2 flex justify-between w-full px-4 py-1"
                :class="{ 'bg-blue-500 text-white': item.vote_status == 1 }"
            >
                <a :href="'/items/' + item.id">
                    <span
                        class="font-semibold"
                        :class="{ 'text-green-700': item.result }"
                        >{{ item.name }}</span
                    >
                </a>

                <drop-down-component
                    :items="item"
                    @fromItem="clickOnItem"
                ></drop-down-component>

            </div>

            <!-- Body  -->
            <div class="flex justify-center w-full cursor-pointer">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mb-5 mt-2 text-gray-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    v-if="readMore"
                    @click="readMore = false"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 13l-7 7-7-7m14-8l-7 7-7-7"
                    />
                </svg>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mb-5 mt-2 text-gray-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    v-else
                    @click="readMore = true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 11l7-7 7 7M5 19l7-7 7 7"
                    />
                </svg>
            </div>

            <transition name="fade">
                <div v-if="!readMore" v-html="item.body"></div>
            </transition>

            <div class="flex justify-between w-full text-sm">
                <!-- <div @click="updateItem(item)"
                     v-if="$auth.can('council delete')"
                     class="p-1 text-center text-sm whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer1 whitespace-no-wrap cursor-pointer">
                    <span v-if="item.published">Publikované</span>
                    <span  v-else :class="{ 'text-red-700' : ! item.published }" >Publikovať</span>
                </div> -->

                <div
                    :class="{
                        ' bg-gray-300 hover:bg-gray-300 rounded-t-lg ':
                            openList,
                    }"
                    class="
                        p-1
                        text-center
                        whitespace-no-wrap
                        flex-1
                        bg-gray-100
                        hover:bg-gray-200
                        cursor-pointer1
                        whitespace-no-wrap
                        cursor-pointer
                    "
                    @click="listToggle"
                    v-if="item.published"
                >
                    Rozprava
                    <span class="text-gray-500">{{
                        item.interpellations.length
                    }}</span>
                </div>

                <div
                    class="
                        p-1
                        text-center
                        whitespace-no-wrap
                        flex-1
                        bg-gray-100
                        cursor-pointer
                    "
                    v-if="item.published && $auth.can('council delete')"
                    :class="
                        item.vote_status == 1
                            ? 'bg-blue-600 text-gray-200 hover:bg-blue-500'
                            : 'text-gray-900 hover:bg-gray-200'
                    "
                    @click="voteStatus"
                    v-text="
                        item.vote_status == 0
                            ? 'Zapnúť hlasovanie'
                            : 'Vypnúť hlasovanie'
                    "
                ></div>
            </div>

            <div class="w-full">
                <vote-form-button :item="item"></vote-form-button>

                <div
                    class="border-2 rounded-md border-gray-300 w-full"
                    v-if="openList"
                >
                    <div class="flex justify-between bg-gray-300 p-1">
                        <h4 class="font-semibold text-gray-800">
                            Do rozpravy
                            <small class="text-sm">
                                ({{ item.interpellations.length }})
                            </small>
                        </h4>
                        <span
                            @click="updateInterpellation(item)"
                            class="text-sm cursor-pointer"
                        >
                            {{ hasUserInterpellation }}
                        </span>
                    </div>

                    <!--    interpellation-->
                    <ul>
                        <li
                            v-for="interpellation in item.interpellations"
                            :key="interpellation.user_id"
                            class="
                                flex
                                justify-between
                                border-b-2 border-dotted
                                px-2
                            "
                        >
                            <span
                                v-text="
                                    interpellation.user.first_name +
                                    ' ' +
                                    interpellation.user.last_name
                                "
                            ></span>
                            <span
                                v-if="$auth.can('council delete')"
                                @click="deleteInterpellation(interpellation)"
                                class="text-gray-800 text-sm cursor-pointer"
                                >x</span
                            >
                        </li>
                    </ul>
                </div>

                <vote-list :item="item"></vote-list>
            </div>
        </div>
    </div>
</template>

<script>
import { bus } from "../app";
import moment from "moment";
import { mapState } from "vuex";
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("items");
import publishedButton from "./publishedButton";
import interpellation from "./InterpellationCard";
import dropDownComponent from "../components/dropDown/dropDownComponent";

export default {
    props: ["item"],
    components: {
        publishedButton,
        interpellation,
        dropDownComponent,
    },
    data: function () {
        return {
            openList: false,
            readMore: true,
        };
    },
    computed: {
        isPublished() {
            if (this.$auth.isAdmin()) {
                return true;
            }
            return this.item.published;
        },
        notificationStatus() {
            return this.item.notification == null
                ? "Výzva k hlasovaniu"
                : moment(this.item.notification).format("DD. MM. YYYY, k:mm");
        },

        hasUserInterpellation: function () {
            var intUsers = this.item.interpellations.map(
                (role) => role.user.id
            );
            return intUsers.includes(this.user.id)
                ? "Odhlásiť sa"
                : "Prihlásiť sa";
        },

        ...mapState({
            meeting: (state) => state.meetings.meeting,
        }),
    },
    methods: {
        ...mapActions([
            "updateInterpellation",
            // "deleteInterpellation",
            // "deleteItemMeeting",
        ]),

        clickOnItem(action, item) {
            if (action == "moveToItems") {
                this.$store.dispatch("meetings/deleteItemMeeting", item);
            }

            if (action == "notifiToVote") {
                this.sendNotification();
            }

            if (action == "published") {
                if (item.votes.length) {
                    alert(
                        "O bode sa hlasovalo. Publikovanie sa nemôže zastaviť!"
                    );
                    return;
                }
                this.updateItem({
                    id: item.id,
                    published: !item.published,
                });
            }
        },

        sendNotification() {
            if (!this.item.published) {
                alert("Bod programu nie je publikovaný. Zapnite publikovanie!");
                return;
            }

            if (!this.meeting.published) {
                alert(
                    "Zastupiteľstvo nie je publikovaný. Zapnite publikovanie!"
                );
                return;
            }
            this.$store.dispatch("items/updateItem", {
                notification: new Date()
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " "),
                id: this.item.id,
            });
        },
        voteStatus: function () {
            if (!this.item.published) {
                alert("Bod programu nie je publikovaný. Zapnite publikovanie!");
                return;
            }

            if (this.item.interpellations.length) {
                alert("Zoznam prihlásených do rozpravy nie je prázdny.");
                return;
            }

            if (!this.meeting.published) {
                alert("Zasadnutie nie je publikované.");
                return;
            }
            this.$store.dispatch("items/updateItem", {
                id: this.item.id,
                vote_status: !this.item.vote_status,
            });
        },

        listToggle: function () {
            if (this.item.vote_status || this.item.votes.length > 0) {
                return alert("Počas hlasovania sú interpelácie vypnuté!");
            }
            this.openList = !this.openList;
        },

        openInterpellation() {
            bus.$emit("imterpellationlist", this.item);
        },

        updateItem: function (item) {
            this.$store.dispatch("items/updateItem", item);
        },

        deleteInterpellation(interpellation) {
            this.$store.dispatch("items/deleteInterpellation", [
                this.item,
                interpellation,
            ]);
        },
    },
};
</script>
<style></style>
