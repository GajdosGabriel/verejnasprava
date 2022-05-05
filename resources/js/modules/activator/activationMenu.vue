<template>
    <div class="border-2 border-gray-300 rounded-md bg-gray-100">
        <card-header
            :icon="'config'"
            :title="'Aktivácia modulov'"
            :title2="statisticActiveModules"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <div v-if="isOpen" class="px-4">
            <transition-group name="fade">
                <div
                    v-for="menu in paidmodules"
                    :key="menu.id"
                    class="bg-white shadow-md my-3"
                >
                    <div
                        class="
                            flex
                            border-t-4 border-teal-500
                            rounded-b
                            text-teal-900
                            px-4
                            py-3
                        "
                    >
                        <div class="py-1">
                            <svg
                                class="fill-current h-6 w-6 text-teal-500 mr-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                                />
                            </svg>
                        </div>
                        <div
                            class="md:flex w-full justify-between items-center"
                        >
                            <div
                                @click="onClickReadMore"
                                class="md:font-bold cursor-pointer"
                            >
                                Modul: {{ menu.name }}
                            </div>
                            <button
                                class="
                                    px-2
                                    py-1
                                    bg-gray-700
                                    text-white
                                    rounded-lg
                                    ml-4
                                    hover:text-gray-200
                                    text-sm
                                "
                                :class="{
                                    'bg-red-700 font-semibold': menu.active,
                                }"
                                @click="saveModul(menu.id)"
                            >
                                {{ menu.active ? "Aktivne" : "Aktivovať" }}
                            </button>
                        </div>
                    </div>
                    <transition name="fade">
                        <div
                            class="px-4 text-sm text-gray-500 pb-2"
                            v-if="readMore"
                        >
                            {{ menu.description }}
                        </div>
                    </transition>
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script>
import cardHeader from "../../components/Cards/CardHeader.vue";
import { mapGetters } from "vuex";
import { createdMixin } from "../../mixins/createdMixin";

export default {
    components: { cardHeader },
    mixins: [createdMixin],
    data() {
        return {
            readMore: false,
        };
    },
    computed: {
        ...mapGetters("organizations", [
            "paidmodules",
            "paidmodulesCount",
            "menuActiveCount",
        ]),
        statisticActiveModules() {
            return this.menuActiveCount + "/" + this.paidmodulesCount;
        },
    },
    methods: {
        saveModul(id) {
            axios
                .put("/api/menus/" + this.user.active_organization, {
                    modul: id,
                })
                .then((response) => {
                    this.$store.dispatch(
                        "organizations/getOrganization",
                        "/api/organizations/" + this.user.active_organization
                    );
                });
        },
        onClickReadMore() {
            this.readMore = !this.readMore;
        },
    },
};
</script>
