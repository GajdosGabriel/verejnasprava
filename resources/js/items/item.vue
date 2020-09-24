<template>
    <div class="flow-root hover:bg-gray-100 p-2">

        <div class="flex justify-between">
            <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
                {{ item.name }}
            </a>
            <published-button></published-button>
        </div>


        <div class="text-center mt-6">
            <button class="text-xs btn mb-3 border-gray-700 border-2 hover:bg-gray-400"
                    :class="item.vote_status == 1 ? 'bg-blue-700 text-gray-200' : ''"
                    @click="voteStatus"
                    v-text="item.vote_status == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
            >
            </button>
        </div>


        <div v-show="item.vote_status">

            <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>

            <itemButtons></itemButtons>

        </div>

        <interpellation></interpellation>

    </div>

</template>

<script>
    import itemButtons from './itemButtons';
    import {mapState} from 'vuex';
    import {mapGetters} from 'vuex';
    import publishedButton from "./publishedButton";
    import interpellation from '../interpellations/interpellationCard';

    export default {
        components: {itemButtons, publishedButton, interpellation},
        props: ['itemId'],
        computed: {
            ...mapState({
                item: state => state.items.item,
                votes: state => state.items.votes,
                interpellations: state => state.items.interpellations,
            }),
        },

        mounted() {
            this.$store.dispatch('items/get_item', this.itemId)
        },
        methods: {

            voteStatus: function () {
                this.$store.dispatch('items/set_vote_status', this.item);
            }
        }

    }
</script>
<style>

</style>
