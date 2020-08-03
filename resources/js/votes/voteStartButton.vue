<template>
    <!--    <a href="{{ route('vote.voteEnable', [$item->id, $item->slug]) }}"-->
    <!--       class="text-xs btn btn-secondary">Zapnúť hlasovanie</a>-->
    <button class="text-xs btn mb-6 w-full" :class="buttonClass" @click="startVote" v-text=" buttonTitle">Zapnúť hlasovanie {{
        item.vote_disabled }}
    </button>
</template>
<script>
    import {bus} from '../app';

    export default {
        props: ['item'],
        data: function () {
            return {

            }
        },
        computed: {
            buttonClass: function () {
                return this.item.vote_disabled ?  'btn-primary' : 'btn-secondary';
            },
            buttonTitle: function () {
                return this.item.vote_disabled ?  'Vypnúť hlasovanie' : 'Zapnúť hlasovanie';
            }
        },
        methods: {
            startVote: function () {
                axios.get('/api/vote/enableVote/' + this.item.id);
                // .then()
                bus.$emit('startVote');
            }
        }
    }
</script>
