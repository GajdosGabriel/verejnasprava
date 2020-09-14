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
            <div v-for="vote in item.votes">
                <itemButtons :vote="vote"></itemButtons>
            </div>

        </div>
    </div>

</template>

<script>
    import itemButtons from './itemButtons';
    import {mapState} from 'vuex';
    import meetingItems from "../store/modules/meeting-item";

    export default {
        components: {itemButtons},
        props: ['item'],
        computed: {
            userVote() {
                return this.item.votes.filter(item => item.user_id == this.user.id)

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
                this.$store.dispatch('meetingItems/set_published_item', this.item);
            },

            storeVote: function (id, val) {
                axios.put('/api/vote/' + id, {userId: this.item.user_id, vote: val});
            }
        }

    }
</script>
