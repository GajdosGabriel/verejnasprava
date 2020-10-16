<template>
    <div class="hover:bg-gray-100 p-2 mb-16 flex flex-col" v-if="isPublished">


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
                                <div class="flex">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/>
                                    </svg>
                                    Upraviť položku
                                </div>
                            </a>

                        </div>

                        <!--  Poslať všetkým notifikáciu -->
                        <a class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           href="#"
                           title="Notifikácia pre voliteľov">
                            <div class="flex" @click="saveNotification">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                                </svg>
                                <span v-text="notificationStatus"></span>
                            </div>
                        </a>


                        <!-- Item Up button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/up'"
                           title="Presunúť položku smerom hore">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
                                </svg>
                                Presunúť hore
                            </div>
                        </a>

                        <!-- Item Down button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/down'"
                           title="Presunúť položku smerom dole">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
                                </svg>
                                Presunúť dole
                            </div>
                        </a>

                        <!-- Item Delete button-->
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/item/'+ item.id + '/' +item.slug + '/item/delete'"
                           title="Zmazať položku">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                                </svg>
                                Zmazať
                            </div>
                        </a>
                    </slot>
                </nav-drop-down>
            </div>


            <div class="flex justify-between w-full text-sm">

                <published-button :item="item"></published-button>

                <div
                    class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-100 cursor-pointer1 whitespace-no-wrap cursor-pointer"
                    @click="openInterpellation"
                >
                    Rozprava <span class="text-gray-500">{{ item.interpellations.length }}</span>
                </div>


                <div class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer"
                     v-if="item.published && $auth.isAdmin()"
                     :class="item.vote_status == 1 ? 'bg-blue-700 text-gray-200' : 'text-gray-900'"
                     @click="voteStatus"
                     v-text="item.vote_status == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
                >

                </div>
            </div>
        </div>


        <vote-form-button :item="item"></vote-form-button>

        <interpellation :item="item"></interpellation>

        <div class="max-w-sm w-full">
            <vote-list :item="item"></vote-list>
        </div>


    </div>

</template>

<script>
    import {bus} from '../app';
    import moment from 'moment';
    // import voteButtons from '../votes/voteButtons';
    import {mapState} from 'vuex';
    import {mapGetters} from 'vuex';
    import publishedButton from "./publishedButton";
    import interpellation from './InterpellationCard';
    import navDropDown from '../modules/navigation/navDropDown';

    export default {
        props: ['item'],
        components: { publishedButton, interpellation, navDropDown},
        computed: {
            isPublished(){
                if (this.$auth.isAdmin()){
                    return true
                }
                return this.item.published
            },
            notificationStatus(){
                return this.item.notification == null ? 'Výzva k hlasovaniu' : moment(this.item.notification).format('DD. MM. YYYY, k:mm');
            },
            curentlyItem: function () {
                return this.$store.getters['meetings/activeItem'](this.item.id);
            }
        },
        mounted() {
            this.$store.dispatch('items/getItem', this.item.id, {root: true})
        },
        methods: {
            saveNotification(){
                this.$store.dispatch('items/update',  {
                    notification: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    meeting_id: this.item.meeting_id,
                    id: this.item.id })
            },
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
