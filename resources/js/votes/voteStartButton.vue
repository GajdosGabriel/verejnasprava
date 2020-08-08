<template>

    <div class="text-center">
        <button class="text-xs btn mb-3 " :class="buttonClass" @click="startVote" v-text=" buttonTitle">
            Zapnúť hlasovanie
        </button>

        <interpelation-table :item="item"/>
    </div>



</template>

<script>
    import {bus} from '../app';
    import interpelationTable from '../interpellations/InterpelationCard.vue';

    export default {
        props: ['itemid'],
        components: {interpelationTable},
        data: function () {
            return {
                item: ''
            }
        },
        created() {
            this.getItem();
            bus.$on('interpelationChange', (data) => {
                this.getItem();
            });
        },
        computed: {
            buttonClass: function () {
                return this.item.vote_disabled == 0 ? 'btn-primary' : 'btn-secondary';
            },
            buttonTitle: function () {
                return this.item.vote_disabled == 0 ? 'Vypnúť hlasovanie' : 'Zapnúť hlasovanie';
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
            getItem: function () {
                axios.get('/api/item/' + this.itemid)
                    .then(response => {
                        this.item = response.data
                    })
            },
            startVote: function () {
                if(! this.canStartVote) {
                    alert('Zoznam prihlásených do rozpravy nie je prázdny.')
                }
                axios.put('/api/item/' + this.item.id)
                    .then(response => {
                        bus.$emit('startVote', false);
                        this.getItem();
                    });
            }
        }
    }
</script>
