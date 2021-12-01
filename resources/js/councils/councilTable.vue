<template>
    <div>
        <div class="mb-4" v-for="council in councils" :key="council.id">
            <div class="flex justify-between flex-wrap">
                <div class="flex whitespace-no-wrap items-center">
                    <h1 class="page-title" :title="council.description">
                        {{ council.name }}
                    </h1>
                    <div class="ml-2">({{ council.meetings_count }})</div>
                </div>

                <div class="flex whitespace-no-wrap">
                    <drop-down-component
                        :items="council"
                        @fromItem="clickOnItem"
                    ></drop-down-component>
                </div>
            </div>
            <div class="flex flex-col sm:ml-5">
                <div
                    class="flex justify-between hover:underline flex-wrap"
                    :class="meeting.published ? '' : 'text-red-700'"
                    v-for="meeting in council.meetings"
                    :key="meeting.id"
                >
                    <a :href="'meetings/' + meeting.id">
                        <strong
                            v-text="
                                moment(meeting.start_at).format('DD. MM. YYYY')
                            "
                        ></strong
                        >, {{ moment(meeting.start_at).format("h:mm") }} hod.
                        <strong>{{ meeting.name }}</strong>
                    </a>

                    <div class="cursor-pointer">
                        <a :href="'meetings/' + meeting.id">
                            Program ({{ meeting.itemspublished.length
                            }}<span
                                v-if="
                                    meeting.itemspublished.length !==
                                    meeting.items.length
                                "
                                >/{{ meeting.items.length }}</span
                            >)
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <component :is="opencomponent" />
    </div>
</template>

<script>
import { mapState } from "vuex";
import { createNamespacedHelpers } from "vuex";

const { mapActions } = createNamespacedHelpers("modals");
import navDropDown from "../modules/navigation/navDropDown";
import modaledit from "./modalEdit";
import modaldelete from "./modalDelete";
import dropDownComponent from "../components/dropDown/dropDownComponent";

export default {
    components: { navDropDown, modaledit, modaldelete, dropDownComponent },
    data: function () {
        return {
            moment: require("moment"),
            opencomponent: "",
        };
    },
    computed: mapState({
        councils: (state) => state.councils.councils,
    }),

    methods: {
        clickOnItem(action, item) {
            if (action == "edit") {
                this.modalEdit(item);
            }

            if (action == "delete") {
                this.modalDelete(item);
            }
        },
        modalEdit: function (item) {
            this.opencomponent = "modaledit";
            this.$store.dispatch("modals/open_form", item);
        },
        modalDelete: function (item) {
            this.opencomponent = "modaldelete";
            this.$store.dispatch("modals/open_form", item);
        },
    },

    created() {
        this.$store.dispatch(
            "councils/fetchCouncils",
            this.user.active_organization
        );
    },
};
</script>
