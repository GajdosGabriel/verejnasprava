<template>
    <div class="flow-root hover:bg-gray-100 p-2 mb-20 flex ">

        <div class="border-2 border-gray-300 max-w-sm">
            <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
                <strong>{{ item.name }}</strong>
            </a>

            <div class="flex justify-between">

                <published-button :item="item"></published-button>

                <span @click="storeInterpellation" v-if="item.published"
                      class="text-sm cursor-pointer mr-4 whitespace-no-wrap">
                    Rozprava
                </span>


                <div class="text-center whitespace-no-wrap" v-if="item.published">
                    <button class="badge badge-primary bg-gray-300  ml-2"
                            :class="item.vote_status == 1 ? 'bg-blue-700 text-gray-200' : 'text-gray-900'"
                            @click="voteStatus"
                            v-text="item.vote_status == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
                    >
                    </button>
                </div>
            </div>
        </div>

        <div v-show="item.vote_status">
            <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>
            <vote-buttons :item="item"></vote-buttons>
        </div>

        <interpellation :item="item"></interpellation>

        <div v-for="vote in item.votes" class="max-w-sm">
            <vote-list :vote="vote"></vote-list>
        </div>


    </div>

</template>

<script>
    import voteButtons from '../votes/votesButton';
    import {mapState} from 'vuex';
    import {mapGetters} from 'vuex';
    import publishedButton from "./publishedButton";
    import interpellation from './InterpellationCard';

    export default {
        props: ['item'],
        components: {voteButtons, publishedButton, interpellation},
        computed: {
            ddddddd: function () {
                return this.$store.getters['meetings/activeItem']
            },
            ...mapState({
                votes: state => state.items.votes,
                interpellations: state => state.items.interpellations,
            }),
        },
        mounted() {
            this.$store.commit('items/SET_ITEM', this.item, {root:true})
        },
        methods: {
            voteStatus: function () {
                this.$store.dispatch('items/set_vote_status', this.item);
            },

            storeInterpellation: function () {
                this.$store.dispatch('items/saveInterpellation', this.item);
            },
        }

    }
</script>
<style>

</style>
