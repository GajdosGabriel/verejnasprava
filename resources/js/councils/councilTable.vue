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
                    <nav-drop-down v-if="$auth.can('council delete')">
                        <slot>
                            <a
                                class="
                                    block
                                    px-4
                                    py-2
                                    text-sm
                                    leading-5
                                    text-gray-700
                                    hover:bg-gray-100 hover:text-gray-900
                                    focus:outline-none
                                    focus:bg-gray-100
                                    focus:text-gray-900
                                    whitespace-no-wrap
                                "
                                :href="
                                    'councils/' +
                                    council.id +
                                    '/meetings/create'
                                "
                                title="Vytvoriť nové zasadnutie"
                            >
                                <div class="flex">
                                    <svg
                                        class="w-4 h-4 mr-2"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"
                                        />
                                    </svg>
                                    Nové zasadnutie
                                </div>
                            </a>

                            <a
                                class="
                                    cursor-pointer
                                    block
                                    px-4
                                    py-2
                                    text-sm
                                    leading-5
                                    text-gray-700
                                    hover:bg-gray-100 hover:text-gray-900
                                    focus:outline-none
                                    focus:bg-gray-100
                                    focus:text-gray-900
                                    whitespace-no-wrap
                                "
                                title="Upraviť položku"
                                @click="modalEdit(council)"
                            >
                                <div class="flex">
                                    <svg
                                        class="w-4 h-4 mr-2"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"
                                        />
                                    </svg>
                                    Upraviť položku
                                </div>
                            </a>

                            <div
                                class="
                                    block
                                    px-4
                                    py-2
                                    cursor-pointer
                                    text-sm
                                    leading-5
                                    text-gray-700
                                    hover:bg-gray-100 hover:text-gray-900
                                    focus:outline-none
                                    focus:bg-gray-100
                                    focus:text-gray-900
                                    whitespace-no-wrap
                                "
                                @click="modalDelete(council)"
                                :href="
                                    'admin/' +
                                    council.id +
                                    '/' +
                                    council.slug +
                                    '/council/delete'
                                "
                                title="Zmazať zastupiteľstvo"
                            >
                                <div class="flex">
                                    <svg
                                        class="w-4 h-4 mr-2"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"
                                        />
                                    </svg>
                                    Zmazať
                                </div>
                            </div>
                        </slot>
                    </nav-drop-down>
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

export default {
    components: { navDropDown, modaledit, modaldelete },
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
