<template>
    <div class="flow-root hover:bg-gray-100 p-2">

        <div class="flex justify-between">
            <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
                {{ item.name }}
            </a>

            <published-button :item="item"></published-button>
        </div>


        <div class="text-center mt-6">
            <button class="text-xs btn mb-3 border-gray-700 border-2 hover:bg-gray-400"
                    :class="item.vote_status == 0 ? 'bg-blue-700 text-gray-200' : ''"
                    @click="startVote"
                    v-text="item.vote_status == 1 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
            >
            </button>
        </div>


        <div v-show="! item.vote_status">

            <h2 class="text-center text-3xl text-gray-600 mt-5">Hlasujte</h2>
                <itemButtons :votes="userVote" :item="item"></itemButtons>

        </div>

            <interpellation :item="item"></interpellation>

    </div>

</template>

<script>
    import itemButtons from './itemButtons';
    import { mapState } from 'vuex';
    import { mapGetters } from 'vuex';
    import publishedButton from "./publishedButton";
    import interpellation from '../interpellations/interpellationCard';

    export default {
        components: {itemButtons, publishedButton, interpellation},
        props: ['item'],
        computed: {
            userVote() {
                return this.item.votes.filter(i => i.user_id == this.user.id)
            },

            currentlyItem() {
              return this.$store.getters['items/getItemById'](this.item.id)
            }
        },
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
                this.$store.dispatch('items/set_vote_status', this.item);
            },

            storeVote: function (id, val) {
                axios.put('/api/vote/' + id, {userId: this.item.user_id, vote: val});
            }
        }

    }
</script>
