<template>
    <div
        v-if="meeting.published"
        class="border-2 rounded-md border-gray-300 mb-12"
    >
        <div
            class="flex justify-between bg-gray-300 p-1 cursor-pointer items-center"
            :class="quorateMeeting"
            @click="openToggle"
        >
            <div class="font-medium text-gray-800">
                <div class="flex cursor-pointer">
                    <icon-user-plus />
                    Prezentácia
                </div>
            </div>

            <span class="text-sm flex">
                ({{ meeting.users.length }}/{{ meeting.council_users.length }})
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
            <ul v-if="openList">
                <li
                    v-for="user in councilUsers"
                    :key="user.id"
                    class="flex justify-between border-b-2 border-dotted px-2 text-gray-600"
                    :class="{
                        'text-gray-700 font-semibold': meeting.users.find(
                            o => o.id == user.id
                        )
                    }"
                >
                    <span
                        v-text="user.first_name + ' ' + user.last_name"
                    ></span>

                    <div v-if="meeting.users.find(o => o.id == user.id)">
                        <svg
                            class="w-4 h-4 mr-1 fill-current my-1 text-gray-500"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"
                            />
                        </svg>
                    </div>
                </li>
            </ul>
        </transition>

        <div v-if="councilUsers < 2" class="text-center">
            V zastupiteľstve nie sú členovia.

            <a href="/users" class="block my-2">
                <button
                    class="border-red-300 bg-red-500 border-2 text-gray-100 hover:bg-red-400 px-1 rounded-md"
                >
                    Pridať člena
                </button>
            </a>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import iconUserPlus from "../components/icons/userPlus.vue";

export default {
    props: {
        councilid: {
            type: Number,
            required: true
        }
    },
    components: { iconUserPlus },
    data() {
        return {
            openList: false
        };
    },
    computed: {
        quorateMeeting() {
            var percento =
                (100 * this.meeting.users.length) / this.meeting.council_users.length;
            // return percento;
            if (percento > this.council.quorate) {
                return "bg-green-200 ";
            }
            return "bg-red-200";
        },
        ...mapState({
            councilUsers: state => state.meetings.councilUsers,
            council: state => state.meetings.council,
            meeting: state => state.meetings.meeting
        })
    },
    created() {
        this.$store.dispatch("meetings/getCouncil", this.councilid);
    },
    methods: {
        openToggle() {
            this.openList = !this.openList;
        }
    }
};
</script>
