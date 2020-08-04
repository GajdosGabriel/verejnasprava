<template>

    <button class="text-xs btn mb-6 w-full" :class="buttonClass" @click="startVote" v-text=" buttonTitle">
        Zapnúť hlasovanie
    </button>

</template>

<script>
    import {bus} from '../app';

    export default {
        props: ['itemid'],
        data: function () {
            return {
                item: ''
            }
        },
        created() {
            this.getItem();
        },
        computed: {
            buttonClass: function () {
                return this.item.vote_disabled == 0 ? 'btn-secondary' : 'btn-primary';
            },
            buttonTitle: function () {
                return this.item.vote_disabled == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie';
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
                axios.get('/api/vote/getItem/' + this.itemid)
                    .then(response => {
                        this.item = response.data
                    })
            },
            startVote: function () {
                if(! this.canStartVote) {
                    alert('Zoznam prihlásených do rozpravy nie je prázdny.')
                }
                axios.get('/api/vote/enableVote/' + this.item.id)
                    .then(response => {
                        bus.$emit('startVote', false);
                        this.getItem();
                    });
            }
        }
    }
</script>
