<template>
    <div class="max-w-sm w-full" v-show="item.vote_status">
        <h3 class="text-center text-2xl text-gray-600">Hlasujte</h3>
        <form method="POST" @submit.prevent>
            <div>
                <div class="md:flex justify-between my-5 bg-gray-100">
                    <!--   Button YES-->
                    <button type="submit" @click="storeVote( 1)"
                            class="btn btn-primary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Súhlasim
                        <div v-if="meVote.vote == 1">
                            <svg
                                class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                            </svg>
                        </div>
                    </button>


                    <!--   Button NotVote-->
                    <button @click="storeVote( 2)"
                            class="btn btn-secondary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Zdržal
                        <div v-if="meVote.vote == 2">
                            <svg
                                class="w-5 h-5 ml-2 text-blue-600 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                            </svg>
                        </div>
                    </button>


                    <!--   Button No-->
                    <button @click="storeVote( 0)"
                            class="btn btn-danger font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Nesúhlasim
                        <div v-if="meVote.vote == 0">
                            <svg
                                class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                            </svg>
                        </div>
                    </button>

                </div>
            </div>
        </form>

    </div>


</template>
<script>
    import {mapState} from "vuex";
    import {mapGetters} from 'vuex';
    export default {
        props:['item'],
        data: function() {
          return {
              meVote: ''
          }
        },
        computed: {
            curentlyItem: function () {
                return this.$store.getters['meetings/activeItem'](this.item.id);
            },
            ...mapState({
                // item: state => state.items.item,
                votes: state => state.items.votes,
                userVote: state => state.items.userVote,
                authUser: state => state.items.authUser,
            }),
        },
        methods: {
            storeVote: function (val) {
                this.$store.dispatch('items/storeVote', { id: this.item.id, userId: this.$auth.user.id, vote:val, meetingId: this.item.meeting_id }, {root:true})
            }
        }
    }

</script>


