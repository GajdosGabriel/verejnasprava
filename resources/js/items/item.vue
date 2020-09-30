<template>
    <div class="hover:bg-gray-100 p-2 mb-16">


        <div class="flex flex-wrap border-2 border-gray-300 max-w-sm">
            <div class="flex justify-between w-full mb-4 px-2">
                <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
                    <span class="font-semibold text-gray-700">{{ item.name }}</span>
                </a>

                <nav-drop-down>
                    <slot>
                        <!-- Item Edit button-->
                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/edit'"
                           title="Upraviť bod programu">
                            Upraviť položku
                        </a>

                        <!-- Item Up button-->
                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/up'"
                           title="Presunúť položku smerom hore">
                            Presúnúť hore
                        </a>

                        <!-- Item Down button-->
                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/down'"
                           title="Presunúť položku smerom dole">
                            Presunúť dole
                        </a>

                        <!-- Item Delete button-->
                        <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/delete'"
                           title="Zmazať položku">
                            Zmazať
                        </a>
                    </slot>
                </nav-drop-down>
            </div>


            <div class="flex justify-between w-full">

                <published-button :item="item"></published-button>

                <div class="text-center">
                    <button @click="openInterpellation" v-if="item.published"
                            class="text-sm cursor-pointer mr-4 whitespace-no-wrap">
                        Rozprava <span class="text-gray-500">{{ item.interpellations.length }}</span>
                    </button>
                </div>


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

        <div v-show="item.vote_status" class="max-w-sm">
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
    import {bus} from '../app';
    import voteButtons from '../votes/votesButton';
    import {mapState} from 'vuex';
    import {mapGetters} from 'vuex';
    import publishedButton from "./publishedButton";
    import interpellation from './InterpellationCard';
    import navDropDown from '../modules/navigation/navDropDown';

    export default {
        props: ['item'],
        components: {voteButtons, publishedButton, interpellation, navDropDown},
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
            this.$store.commit('items/SET_ITEM', this.item, {root: true})
        },
        methods: {
            voteStatus: function () {
                this.$store.dispatch('items/set_vote_status', this.item);
            },

            storeInterpellation: function () {
                this.$store.dispatch('interpellations/store', this.item);
            },

            openInterpellation() {
                bus.$emit('imterpellationlist', this.item);
            }
        }

    }
</script>
<style>

</style>
