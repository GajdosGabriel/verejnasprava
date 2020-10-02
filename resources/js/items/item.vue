<template>
    <div class="hover:bg-gray-100 p-2 mb-16 flex flex-col">


        <div class="flex flex-wrap border-2 border-gray-300 max-w-sm mb-4 mr-2">
            <div class="flex justify-between w-full mb-4 px-2">
                <a :href="'/item/' + item.id + '/' + item.slug + '/show'">
                    <span class="font-semibold text-gray-700">{{ item.name }}</span>
                </a>

                <nav-drop-down>
                    <slot>
                        <!-- Item Edit button-->
                        <div class="py-1">
                            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                               :href="'/item/'+ item.id + '/' +item.slug + '/edit'"
                               title="Upraviť bod programu">
                                Upraviť položku
                            </a>

                        </div>
                        <!-- Item Up button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/up'"
                           title="Presunúť položku smerom hore">
                            Presúnúť hore
                        </a>

                        <!-- Item Down button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/down'"
                           title="Presunúť položku smerom dole">
                            Presunúť dole
                        </a>

                        <!-- Item Delete button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/delete'"
                           title="Zmazať položku">
                            Zmazať
                        </a>
                    </slot>
                </nav-drop-down>
            </div>


            <div class="flex justify-between w-full text-sm">

                <published-button :item="item"></published-button>

                <div
                    class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-100 cursor-pointer1 whitespace-no-wrap cursor-pointer"
                    @click="openInterpellation" v-if="item.published"
                >
                    Rozprava <span class="text-gray-500">{{ item.interpellations.length }}</span>
                </div>


                <div class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer"
                     v-if="item.published"
                     :class="item.vote_status == 1 ? 'bg-blue-700 text-gray-200' : 'text-gray-900'"
                     @click="voteStatus"
                     v-text="item.vote_status == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
                >

                </div>
            </div>
        </div>


        <vote-buttons :item="item"></vote-buttons>

        <interpellation :item="item"></interpellation>

        <div v-for="vote in item.votes" class="max-w-sm w-full">
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
            curentlyItem: function () {
                return this.$store.getters['meetings/activeItem'](this.item.id);
            }
        },
        mounted() {
            this.$store.dispatch('items/get_item', this.item.id, {root: true})
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
