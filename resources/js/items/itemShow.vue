<template>
    <div class="p-3 w-full sm:flex">
        <div class="sm:mx-3 border-gray-300 border-2 p-4 md:w-8/12 xs:w-full">
            <div class="w-full">
                <h1
                    class="text-lg page-title"
                    :class="{ 'text-green-700': item.result }"
                >
                    {{ item.name }}
                </h1>

                <span class="text-sm text-gray-500"
                    >Návrh uznesenia vypracoval: {{ user.first_name }}
                    {{ user.last_name }}, {{ user.employment }}</span
                >
                <!--   Badge line-->
                <div
                    class="
                        flex
                        justify-between
                        mt-3
                        mb-5
                        py-1
                        border-gray-200 border-t-2 border-b-2
                        items-center
                    "
                >
                    <div class="flex flex-wrap items-center space-x-3">
                        <div
                            v-text="
                                item.vote_type == 0
                                    ? 'Hlasovanie verejné'
                                    : 'Hlasovanie tajné'
                            "
                            class="badge badge-primary"
                        ></div>

                        <published-button :item="item"></published-button>

                        <div
                            @click="openInterpellation"
                            class="
                                cursor-pointer
                                flex
                                text-gray-700 text-sm
                                rounded-md
                            "
                        >
                            Rozprava {{ interpellations.length }}
                        </div>
                    </div>

                    <drop-down-component
                        :items="item"
                        @fromItem="clickOnItem"
                    ></drop-down-component>
                </div>

                <!--  Votes Buttons-->
                <vote-form-button :item="item"></vote-form-button>

                <!--                <vote-list :item="item"></vote-list>-->

                <!--  Body text-->
                <div class="py-3">
                    <p v-html="item.body"></p>
                    <!--  File-->
                    <div v-if="files.length">
                        <h5
                            class="mt-4"
                            style="border-bottom: 2px solid silver"
                        >
                            Príloha
                        </h5>
                        <div v-for="(file, index) in files" :key="file.id">
                            <a
                                class="mr-2 hover:text-blue-500"
                                target="_blank"
                                :title="file.org_name"
                                :href="
                                    '/file/' +
                                    file.id +
                                    '/' +
                                    file.filename +
                                    '/file/show'
                                "
                            >
                                {{ index + 1 }}. Príloha
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  Aside part-->
        <div
            class="border-gray-300 border-2 sm:mx-3 p-4 flex flex-col md:w-4/12"
        >
            <vote-start-button :item="item"></vote-start-button>

            <!--            &lt;!&ndash;Vote results Variant I.&ndash;&gt;-->
            <!--            <ul class="mb-10 border-2 border-gray-500 rounded-md shadow-md w-full">-->
            <!--                <li class="flex justify-between px-3 font-semibold text-gray-200 bg-gray-800 border-b-2"><span>Hlasovalo:</span>-->
            <!--&lt;!&ndash;                    <span>{{ item.votes.length }}</span>&ndash;&gt;-->
            <!--                </li>-->
            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Za:</span>-->
            <!--                    <span>{{ resultYes }}</span>-->
            <!--                </li>-->

            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Proti:</span>-->
            <!--                    <span>{{ resultNo }}</span>-->
            <!--                </li>-->

            <!--                <li class="flex justify-between px-3 font-semibold border-b-2 border-dotted"><span>Zdržal:</span>-->
            <!--                    <span>{{ resultDisition }}</span>-->
            <!--                </li>-->
            <!--            </ul>-->

            <!-- Výsledky hlasovania-->

            <interpellation :item="item"></interpellation>

            <div class="">
                <div
                    class="
                        flex
                        my-5
                        items-center
                        justify-between
                        border-t-2 border-b-2 border-gray-300
                    "
                    v-if="item.vote_status || votes.length > 0"
                >
                    <h2 class="text-lg font-semibold whitespace-no-wrap">
                        Výsledky hlasovania
                    </h2>
                    <div class="text-sm cursor-pointer">
                        <span title="Áno" v-text="countYes"></span>
                        -
                        <span title="Zdržal sa" v-text="countUndecided"></span>
                        -
                        <span title="Nie" v-text="countNo"></span>
                    </div>
                </div>

                <ul class="">
                    <li
                        v-for="vote in item.votes"
                        :key="vote.id"
                        class="flex justify-between border-b-2 border-dotted"
                    >
                        {{ vote.user.last_name }} {{ vote.user.first_name }}
                        <div v-if="item.vote_type == 0">
                            <span v-if="vote.vote == 1" class="font-semibold"
                                >Áno</span
                            >
                            <span v-if="vote.vote == 0" class="font-semibold"
                                >Nie</span
                            >
                            <span v-if="vote.vote == 2" class="font-semibold"
                                >Zdržal</span
                            >
                        </div>
                        <span v-else class="font-semibold">Hlasoval</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import moment from "moment";
import publishedButton from "./publishedButton";
import interpellation from "./InterpellationCard";

import dropDownComponent from "../components/dropDown/dropDownComponent";

export default {
    props: ["pitem"],
    components: { publishedButton, interpellation, dropDownComponent },
    computed: {
        countYes() {
            return this.votes.filter((value) => value.vote == 1).length;
        },
        countUndecided() {
            return this.votes.filter((value) => value.vote == 2).length;
        },
        countNo() {
            return this.votes.filter((value) => value.vote == 0).length;
        },

        ...mapState({
            item: (state) => state.items.item,
            user: (state) => state.items.user,
            votes: (state) => state.items.votes,
            interpellations: (state) => state.items.interpellations,
            files: (state) => state.items.files,
        }),
    },
    created: function () {
        this.$store.dispatch("items/getItem", this.pitem);
    },
    methods: {
        clickOnItem(action, item) {
            if (action == "moveToItems") {
                this.$store.dispatch("meetings/deleteItemMeeting", item);
            }

            if (action == "notifiToVote") {
                if (this.item.notification != null) {
                    alert("Výzva na hlasovanie bola znova zaslaná.");
                }
                this.sendNotification();
            }

            if (action == "delete") {
          
                this.$store.dispatch("items/deleteItem", item);
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

        // itemDelete(item) {
        //     axios.delete("/items/" + item.id).then(
        //         // (location.href = "/items")
        //         // window.location.reload()
        //     );
        // },
        sendNotification() {
            this.$store.dispatch("items/updateItem", {
                notification: new Date()
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " "),
                id: this.item.id,
            });
        },

        openInterpellation() {
            bus.$emit("imterpellationlist", this.item);
        },
    },
};
</script>
