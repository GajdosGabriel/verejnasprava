<template>
    <div class="mb-6">

        <div class="flex justify-between max-w-sm">
<!--                        <h1 class="page-title">{{ meeting.name }}</h1>-->
            <div class="">
                <span class="text-gray-700">Začiatok: {{ moment(meeting.start_at).format('DD. MM. YYYY') }}</span>
                <strong>{{ moment(meeting.start_at).format('h:mm') }} hod.</strong>
            </div>

            <nav-drop-down>
                <slot>
                    <div class="py-1">
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/meet/'+ meeting.id + '/' + meeting.slug + '/createItem'"
                           title="Vytvoriť nové zasadnutie">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/>
                                </svg>
                                Nový bod
                            </div>
                        </a>
                    </div>

                    <!-- Meeting Edit button-->
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       :href="'/meet/'+ meeting.id + '/' + meeting.slug + '/meeting/edit'"
                       title="Zmazať položku">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/>
                            </svg>
                            Upraviť položku
                        </div>
                    </a>

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

                    <!-- Meeting Delete button-->
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       :href="'/meet/'+ meeting.id + '/' + meeting.slug + '/meeting/delete'"
                       title="Zmazať položku">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                            </svg>
                            Zmazať
                        </div>
                    </a>

                </slot>
            </nav-drop-down>
        </div>

        <div v-for="item in meeting.items" :key="item.id" class="odd:bg-gray-500 mt-4 bg-white">
            <item :item="item"></item>
        </div>


    </div>

</template>

<script>
    import moment from 'moment';
    import navDropDown from '../modules/navigation/navDropDown';
    import {mapState} from 'vuex';
    import item from '../items/itemList';

    export default {
        props: ['pmeeting'],
        components: {item, navDropDown},
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: {
            notificationStatus() {
                return this.meeting.notification == null ? 'Pozvánka pre členov' : moment(this.meeting.notification).format('DD. MM. YYYY, HH:mm');
            },
            ...mapState({
                meeting: state => state.meetings.meeting,
            })
        },

        created() {
            this.$store.dispatch('meetings/fetchMeeting', this.pmeeting.id);
        },
        methods: {
            saveNotification(){
                this.$store.dispatch('meetings/update',  {
                    notification: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    id: this.meeting.id })
            }
        }

    }
</script>
