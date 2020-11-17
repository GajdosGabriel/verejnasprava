<template>
    <div class="border-2 rounded-md border-gray-300 max-w-sm mb-12"  @click="openToggle">
        <div class="flex justify-between bg-gray-300 p-1 cursor-pointer items-center" :class="quorateMeeting">
            <div class="font-medium text-gray-800">
                <div class="flex cursor-pointer">
                    <svg class="w-4 h-4 mr-1 fill-current my-1 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2 6H0v2h2v2h2V8h2V6H4V4H2v2zm7 0a3 3 0 0 1 6 0v2a3 3 0 0 1-6 0V6zm11 9.14A15.93 15.93 0 0 0 12 13c-2.91 0-5.65.78-8 2.14V18h16v-2.86z"/>
                    </svg>
                    Prihlásený
                </div>
            </div>

            <span class="text-sm flex">
               ({{ meetingUsers.length }}/ {{ councilUsers.length }})
            </span>

            <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>

        </div>

        <ul v-if="openList">
            <li v-for="user in councilUsers" :key="user.id"
                class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="user.first_name + ' ' + user.last_name"></span>
            </li>
        </ul>

    </div>

</template>

<script>
    import {mapState} from "vuex";

    export default {
        data() {
            return {
                openList: false
            }
        },
        computed: {
            // activeUser(){
            //
            // },
            quorateMeeting() {
                var percento = (100 * this.meetingUsers.length) / this.councilUsers.length;
                // return percento;
                if (percento > this.council.quorate) {
                    return 'bg-green-200 '
                }
                return 'bg-red-200'
            },
            ...mapState({
                meetingUsers: state => state.meetings.meetingUsers,
                councilUsers: state => state.meetings.councilUsers,
                council: state => state.meetings.council,
                meeting: state => state.meetings.meeting
            })
        },
        created() {
            this.$store.dispatch('meetings/getCouncil', 1)
        },
        methods: {
            openToggle() {
                this.openList = !this.openList
            }
        }

    }
</script>
