<template>
    <section class="border" v-if="meeting">
        <header
            class="flex justify-between items-center px-2 py-2"
        >
            <div class="flex">
                <svg
                    class="fill-current h-5 w-5 mr-2"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path
                        fill-rule="evenodd"
                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                        clip-rule="evenodd"
                    />
                </svg>
                <h3 class="">
                    Najbližšie zastupiteľstvo
                </h3>
            </div>
            <a class="hover:text-red-600 hover:underline" :href="'/meetings/' +  meeting.id">{{ meeting.name }}</a>
        </header>
    </section>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meeting: null
        };
    },
    created() {
        this.getMeeting();
    },

    methods: {
        getMeeting() {
            axios
                .get("/api/users/" + this.user.id + "/meetings")
                .then(response => {
                    this.meeting = response.data;
                });
        }
    }
};
</script>
