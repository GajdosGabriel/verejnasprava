<template>
    <div>
        <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
            {{ item.name }}
        </a>


        <div class="text-center">
            <button class="text-xs btn mb-3 border-gray-700 border-2 hover:bg-blue-500"
                    :class="item.vote_disabled == 0 ? 'bg-blue-700 text-gray-200' : ''"
                    @click="startVote"
                    v-text="item.vote_disabled == 1 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
            >
            </button>
        </div>

        <itemButtons :itemm="item"></itemButtons>

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
            }
        }

    }
</script>
