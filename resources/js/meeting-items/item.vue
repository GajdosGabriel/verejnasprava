<template>
    <div class="flow-root">
        <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
            {{ item.name }}
        </a>


        <div class="text-center">
            <button class="text-xs btn mb-3 border-gray-700 border-2 hover:bg-blue-500"
                    :class="item.vote_status == 0 ? 'bg-blue-700 text-gray-200' : ''"
                    @click="startVote"
                    v-text="item.vote_status == 1 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
            >
            </button>
        </div>


        <div v-show="! item.vote_status">
            <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>
            <form method="POST" @submit.prevent>
                <div class="md:flex justify-between my-5 bg-gray-100">
                    <!--   Button YES-->
                    <button type="submit" @click="storeVote( item.id, 1)"
                            class="btn btn-primary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Súhlasim
                        <svg
                            class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                        </svg>
                    </button>


                    <!--   Button NotVote-->
                    <button @click="storeVote(item.id, 2)"
                            class="btn btn-secondary font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Zdržal
                        <svg
                            class="w-5 h-5 ml-2 text-blue-600 fill-current"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                        </svg>
                    </button>


                    <!--   Button No-->
                    <button @click="storeVote(item.id, 0)"
                            class="btn btn-danger font-semibold flex items-center justify-center md:w-auto w-full my-3">
                        Nesúhlasim
                        <svg

                            class="w-5 h-5 ml-2 text-white fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z"/>
                        </svg>
                    </button>


                </div>
            </form>
        </div>
        <!--        <div v-for="vote in item.votes">-->
        <!--            <itemButtons :vote="vote"></itemButtons>-->
        <!--        </div>-->

    </div>

</template>

<script>
    import itemButtons from './itemButtons';
    import {bus} from "../app";

    export default {
        components: {itemButtons},
        props: ['item'],
        methods: {
            startVote: function () {
                if (!this.item.interpellations) {
                    alert('Zoznam prihlásených do rozpravy nie je prázdny.');
                    return
                }

                if (!this.item.published) {
                    alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
                    return
                }
                this.$store.dispatch('meetingItems/set_published_item', this.item);
            },

            storeVote: function (id, val) {
                axios.put('/api/vote/' + id, {userId: this.item.user_id, vote: val});
            }
        }

    }
</script>
