<template>

    <div class="text-center">
        <button class="text-xs btn mb-3 whitespace-no-wrap" :class="buttonClass" @click="voteStatus" v-text=" buttonTitle">
            Zapnúť hlasovanie
        </button>
    </div>



</template>

<script>
    import {bus} from '../app';
    import interpellationTable from '../items/InterpellationCard.vue';
    import {mapState} from 'vuex';
    import {mapGetters} from 'vuex';

    export default {
        props: ['item'],
        computed: {
            ...mapState({
                // item: state => state.items.item,
            }),
            buttonClass: function () {
                return this.item.vote_status == 1 ? 'btn-primary' : 'btn-secondary';
            },
            buttonTitle: function () {
                return this.item.vote_status == 1 ? 'Vypnúť hlasovanie' : 'Zapnúť hlasovanie';
            },
            canStartVote: function () {
                if(this.item.interpellations.length > 0) {
                    return false;
                } else {
                    return true;
                }
            }
        },
        methods: {
            voteStatus: function () {
                if (!this.item.published) {
                    alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
                    return
                }

                if (this.item.interpellations.length) {
                    alert('Zoznam prihlásených do rozpravy nie je prázdny.');
                    return
                }
                this.$store.dispatch('items/update', {id: this.item.id, vote_status: ! this.item.vote_status, meeting_id: this.item.meeting_id})
            },
        }
    }
</script>
