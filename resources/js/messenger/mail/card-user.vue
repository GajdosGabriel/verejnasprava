<template>
    <div class="border" v-if="isModulActiveById">
        <card-header
            :icon="'mail'"
            :title="' Oznámenia zamestnávateľa'"
            :title2="unreadMessages"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />
        <div class="flex flex-col px-2" v-if="isOpen">
            <div
                class="py-0 px-1 hover:bg-gray-100"
                v-for="message in messengers.data"
                :key="message.id"
            >
                <div
                    @click="passMessage(message)"
                    class="md:flex justify-between cursor-pointer items-center"
                >
                    <div>{{ message.name }}</div>
                    <span
                        v-if="message.pivot.opened == null"
                        class="px-1 my-1 bg-red-600 text-xs text-white rounded-sm"
                        title="Potvrdiť prijatie správy"
                        >Nepotvrdená</span
                    >
                    <span
                        v-else
                        title="Doručené"
                        class="text-xs text-gray-500"
                        v-text="dateTime(message)"
                    ></span>
                </div>
            </div>

            <pagination :data="messengers" @urlMessengers="getMessengers" />
        </div>

        <show-modal
            :showModal="showModal"
            :message="message"
            @emitShowModal="showModal = false"
            @saveReading="saveReading"
            @destroyMessage="destroyMessage"
        ></show-modal>
    </div>
</template>

<script>
import cardHeader from "../../components/Cards/CardHeader.vue";
import showModal from "./show-modal";
import moment from "moment";
import { bus } from "../../app";
import pagination from "../pagination";
import { mapState, mapGetters } from "vuex";
import { createdMixin } from "../../mixins/createdMixin";
export default {
    mixins: [createdMixin],
    components: { showModal, pagination, cardHeader },
    data() {
        return {
            isOpen: false,
            showModal: false,
            messengers: [],
            message: {}
        };
    },
    computed: {
        ...mapGetters("organizations", ["menuActive"]),
        unreadMessages() {
            return (this.messengers.data || []).filter(
                m => m.pivot.opened == null
            ).length;
        },

        isModulActiveById() {
            return this.$store.getters["organizations/menuActive"](10);
        }
    },
    created() {
        this.getMessengers();
        bus.$on("addNewMessage", data => {
            this.getMessengers();
        });
    },
    methods: {
        dateTime(message) {
            return moment(message.pivot.created_at).format(
                "DD. MM. YYYY, k:mm"
            );
        },
        passMessage(message) {
            this.showModal = true;
            this.message = message;
        },

        destroyMessage(message) {
            if (message.pivot.opened == null) {
                return alert("Nepotvrdenú správu nemožno zmazať.");
            }
            axios.delete("/messengers/" + message.id).then(
                res => {
                    this.getMessengers();
                },

                (this.showModal = false)
            );
        },

        saveReading() {
            axios.put("/messengers/" + this.message.id, this.message).then(
                res => {
                    this.getMessengers();
                },

                (this.showModal = false)
            );
        },
        getMessengers(url) {
            if (url == null) {
                var activeUrl = "/messengers";
            } else {
                var activeUrl = url;
            }

            axios.get(activeUrl).then(res => {
                this.messengers = res.data;
            });
        }
    }
};
</script>
<style>
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import "~quill/dist/quill.core.css";
@import "~quill/dist/quill.bubble.css";
@import "~quill/dist/quill.snow.css";
</style>
