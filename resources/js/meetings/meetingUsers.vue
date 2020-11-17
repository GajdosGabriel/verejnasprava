<template>
    <div class=" border-2 rounded-md border-gray-300 w-full mb-12" @click="openToggle">
        <div class="lg:flex lg:justify-between bg-gray-300 p-1 cursor-pointer items-center">
            <div class="font-medium text-gray-800">
                <div class="flex cursor-pointer">
                    <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                Prihlásený
            </div>

            <span class="text-sm flex">
                                <svg class="w-4 h-4 mr-1 fill-current my-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 6H0v2h2v2h2V8h2V6H4V4H2v2zm7 0a3 3 0 0 1 6 0v2a3 3 0 0 1-6 0V6zm11 9.14A15.93 15.93 0 0 0 12 13c-2.91 0-5.65.78-8 2.14V18h16v-2.86z"/></svg>
                {{ meetingUsers.length }}
            </span>

        </div>

        <ul v-if="openList">
            <li v-for="user in meetingUsers" :key="user.id"
                class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="user.first_name + ' ' + user.last_name"></span>
            </li>
        </ul>

    </div>

</template>

<script>
    import {mapState} from "vuex";

    export default {
        data(){
            return{
                openList: false
            }
        },
        computed:{
            ...mapState({
                meetingUsers: state => state.meetings.meetingUsers,
                meeting: state => state.meetings.meeting
            })

        },
        created(){
          axios.get('/api/councils/' + 1)
          .then(response => {
                  console.log(response.data)
              }
          )
        },
        methods:{
            openToggle(){
                this.openList =! this.openList
            }
        }

    }
</script>
