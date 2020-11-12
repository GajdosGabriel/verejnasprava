<template>

    <div class="border-2 rounded-md border-gray-300 my-5 max-w-sm w-full"  v-if="item.vote_status || item.votes.length > 0"  @click="itemShowList">
        <div class="flex justify-between bg-gray-300 p-1">
            <h4 class="font-semibold text-gray-800">Hlasovanie ({{ item.votes.length }})</h4>
            <div class="flex cursor-pointer">
                <div title="Áno" v-text="countYes"></div>-
                <div title="Zdržal sa" v-text="countUndecided"></div>-
                <div title="Nie" v-text="countNo"></div>
            </div>

            <div class="flex cursor-pointer">
                <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <ul v-if="vote_list">
            <!-- Hlas Za-->
            <li v-for="vote in item.votes" class="flex justify-between border-b-2 border-dotted">
                {{ vote.user.first_name + ' ' +vote.user.last_name}}
                <span class="font-medium">{{ voteType(vote.vote) }}</span>
            </li>
        </ul>
    </div>

</template>

<script>
    export default {
        props: ['item'],
        data(){
            return {
                vote_list: false
            }
        },
        computed: {
            countYes() {
                return this.item.votes.filter(value => value.vote == 1).length
            },
            countUndecided() {
                return this.item.votes.filter(value => value.vote == 2).length
            },
            countNo() {
                return this.item.votes.filter(value => value.vote == 0).length
            },
        },
        methods: {
            voteType: function (vote) {
                if (vote == 2) {
                    return 'Zdržal'
                }

                if (vote == 1) {
                    return 'ÁNO'
                }

                if (vote == 0) {
                    return 'NIE'
                }
            },
            itemShowList: function(){
                this.vote_list = ! this.vote_list;
                this.$store.dispatch('meetings/fetchMeeting', this.item.pivot.meeting_id)
            }
        }

    }
</script>
