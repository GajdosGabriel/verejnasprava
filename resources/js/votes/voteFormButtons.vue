<template>
    <div v-show="item.vote_disabled">

        <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>
        <form method="POST" @submit.prevent>
            <div class="md:flex justify-between my-5 bg-gray-100">
                <!--   Button YES-->
                <button type="submit" @click="storeVote(1)"
                        class="btn btn-primary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                    Súhlasim
                    <svg v-if="vote.vote == 1" class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                    </svg>
                </button>


                <!--   Button NotVote-->
                <button  @click="storeVote(2)"
                        class="btn btn-secondary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                    Zdržal
                    <svg v-if="vote.vote == 2" class="w-5 h-5 ml-2 text-blue-600 fill-current"
                         xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                    </svg>
                </button>


                <!--   Button No-->
                <button @click="storeVote(0)"
                        class="btn btn-danger font-semibold flex items-center justify-center md:w-auto w-full my-3">
                    Nesúhlasim
                    <svg v-if="vote.vote == 0" class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                    </svg>
                </button>


            </div>
        </form>

    </div>

</template>
<script>
    import {bus} from '../app';

    export default {
        props: ['itemid'],
        data: function () {
            return {
                item: '',
                vote: ''
            }
        },
        // computed: {
        //     voteStatus: function() {
        //        return this.item.vote_disabled == 0 ? true : false;
        //     }
        // },
        created: function () {
            this.getItem();
            bus.$on('startVote', (data) => {
                this.getItem();
            });
        },
        methods: {
            getItem: function () {
                axios.get('/api/vote/getItem/' + this.itemid)
                    .then(response => {
                        this.item = response.data
                    })
            },
            storeVote: function (val) {
                axios.post('/api/vote/' + this.item.id + '/store', { userId: this.item.user_id,  vote: val})
                .then(response => {
                    this.vote = response.data;
                    this.getItem();
                });
            }
        }
    }

</script>
