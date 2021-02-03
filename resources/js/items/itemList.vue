<template>
    <div class="border-gray-300" v-if="isPublished">

        <div class="flex flex-wrap border-2 mb-4" :class="{ 'border-red-300' : ! item.published , 'border-green-500' : item.result, 'border-blue-500 rounded-sm' : item.vote_status == 1 }" >
            <div class="border-b-2 flex justify-between w-full px-4 py-1"
            :class="{'bg-blue-500 text-white' : item.vote_status == 1}"
            >
                <a :href="'/items/' + item.id">
                    <span class="font-semibold " :class="{'text-green-700' : item.result }">{{ item.name }}</span>
                </a>

                <nav-drop-down v-if="$auth.can('council delete')">
                    <slot>
                        <!-- Item Edit button-->
                        <div class="py-1">
                            <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                               :href="'/items/'+ item.id + '/edit'"
                               title="Upraviť bod programu">
                                <div class="flex">
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                                </svg>
                                <span v-text="notificationStatus"></span>
                            </div>
                        </a>

                        <!-- Item Delete button-->
                        <button class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                                @click="deleteItemMeeting(item)"
                           title="Zmazať položku">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 7H2v6h8v5l8-8-8-8v5z"/>
                                </svg>
                                Späť do návrhoch
                            </div>
                        </button>
                    </slot>
                </nav-drop-down>
            </div>


            <div class="flex justify-between w-full text-sm">

                <div @click="updateItem(item)"
                     v-if="$auth.can('council delete')"
                     class="p-1 text-center text-sm whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer1 whitespace-no-wrap cursor-pointer">
                    <span v-if="item.published">Publikované</span>
                    <span  v-else :class="{ 'text-red-700' : ! item.published }" >Publikovať</span>
                </div>


                <div
                    class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-100 cursor-pointer1 whitespace-no-wrap cursor-pointer"
                    @click="listToggle"
                    v-if="item.published"
                >
                    Rozprava <span class="text-gray-500">{{ item.interpellations.length }}</span>
                </div>


                <div class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer"
                     v-if="item.published && $auth.can('council delete')"
                     :class="item.vote_status == 1 ? 'bg-blue-700 text-gray-200' : 'text-gray-900'"
                     @click="voteStatus"
                     v-text="item.vote_status == 0 ? 'Zapnúť hlasovanie' : 'Vypnúť hlasovanie'"
                >

                </div>
            </div>

            <div class="max-w-sm w-full">

                <vote-form-button :item="item"></vote-form-button>

                <div class=" border-2 rounded-md border-gray-300 w-full"
                     v-if="openList"
                >
                    <div class="flex justify-between bg-gray-300 p-1">
                        <h4 class="font-semibold text-gray-800">Do rozpravy <small class="text-sm">

                            ({{ item.interpellations.length }})
                        </small></h4>
                        <span @click="updateInterpellation(item)" class="text-sm cursor-pointer">
                {{ hasUserInterpellation }}
            </span>
                    </div>

                    <!--    interpellation-->
                    <ul>
                        <li v-for="interpellation in item.interpellations" :key="interpellation.user_id"
                            class="flex justify-between border-b-2 border-dotted px-2">
                            <span v-text="interpellation.user.first_name + ' ' + interpellation.user.last_name"></span>
                            <span v-if="$auth.can('council delete')" @click="deleteInterpellation(interpellation)" class="text-gray-800 text-sm cursor-pointer">x</span>
                        </li>
                    </ul>

                </div>

                <vote-list :item="item"></vote-list>
            </div>
        </div>

    </div>

</template>

<script>
    import {bus} from '../app';
    import moment from 'moment';
    import {mapState} from "vuex";
    import { createNamespacedHelpers } from 'vuex';
    const { mapActions } = createNamespacedHelpers('meetings');
    import publishedButton from "./publishedButton";
    import interpellation from './InterpellationCard';
    import navDropDown from '../modules/navigation/navDropDown';

    export default {
        props: ['item'],
        components: { publishedButton, interpellation, navDropDown},
        data: function(){
            return {
                openList: false
            }
        },
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

            hasUserInterpellation: function () {
                var intUsers = this.item.interpellations.map(role => role.user.id);
                return  intUsers.includes( this.user.id) ? 'Odhlásiť sa' : 'Prihlásiť sa';
            },

            ...mapState({
                meeting: state => state.meetings.meeting
            })
        },
        methods: {
            ...mapActions([
                'updateInterpellation',
                'deleteInterpellation',
                'deleteItemMeeting'
            ]),

            saveNotification(){
                if (!this.item.published) {
                    alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
                    return
                }

                if (!this.meeting.published) {
                    alert('Zastupiteľstvo nie je publikovaný. Zapnite publikovanie!');
                    return
                }
                this.$store.dispatch('items/update',  {
                    notification: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    id: this.item.id });
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

                if (! this.meeting.published) {
                    alert('Zasadnutie nie je publikované.');
                    return
                }
                this.$store.dispatch('meetings/updateItem', {id: this.item.id, vote_status: ! this.item.vote_status})
            },

            listToggle: function(){
                if(this.item.vote_status || this.item.votes.length > 0){
                    return alert('Počas hlasovania sú interpelácie vypnuté!')
                }
                this.openList = ! this.openList
            },

            openInterpellation() {
                bus.$emit('imterpellationlist', this.item);
            },

            updateItem: function(item){
                if (item.votes.length){
                    alert('O bode sa hlasovalo. Publikovanie sa nemôže zrušiť!');
                    return
                }
                this.$store.dispatch('meetings/updateItem', {id: item.id, published: ! item.published})
            }
        }

    }
</script>
<style>

</style>
