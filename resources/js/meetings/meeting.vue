<template>
    <div v-cloak>

        <div class="flex justify-between max-w-sm border-b-2 border-gray-400 mb-2"
             :class="{ 'border-red-300' : ! meeting.published }">
            <div class="">
                <span class="text-gray-700 font-semibold" :class="{ 'text-red-700' : ! meeting.published }">Začiatok: {{ moment(meeting.start_at).format('DD. MM. YYYY') }}</span>
                <span :class="{ 'text-red-700' : ! meeting.published }">{{ moment(meeting.start_at).format('H:mm') }} hod.</span>
            </div>

            <nav-drop-down v-if="$auth.can('council delete')">
                <slot>
                    <div class="py-1">
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                           :href="'/itemMeeting/'+ meeting.id + '/create'"
                           title="Vytvoriť nové zasadnutie">
                            <div class="flex">
                                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/>
                                </svg>
                                Nový bod
                            </div>
                        </a>
                    </div>

                    <!-- Meeting published button-->
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       href="#"
                       title="Zmazať položku">
                        <div v-if="meeting.published" @click="publishedMeeting(! meeting.published)" class="flex">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M12.81 4.36l-1.77 1.78a4 4 0 0 0-4.9 4.9l-2.76 2.75C2.06 12.79.96 11.49.2 10a11 11 0 0 1 12.6-5.64zm3.8 1.85c1.33 1 2.43 2.3 3.2 3.79a11 11 0 0 1-12.62 5.64l1.77-1.78a4 4 0 0 0 4.9-4.9l2.76-2.75zm-.25-3.99l1.42 1.42L3.64 17.78l-1.42-1.42L16.36 2.22z"/>
                            </svg>
                            Zastaviť publikovanie
                        </div>
                        <div v-else class="flex" @click="publishedMeeting(1)"
                             :class="{ 'text-red-700' : ! meeting.published }">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                            </svg>
                            Publikovať zasadnutie
                        </div>
                    </a>

                    <!-- Meeting Edit button-->
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       :href="'/meetings/'+ meeting.id + '/edit'"
                       title="Zmazať položku">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/>
                            </svg>
                            Upraviť zasadnutie
                        </div>
                    </a>

                    <!--  Poslať všetkým notifikáciu -->
                    <a v-if="meeting.published"
                       class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       href="#"
                       title="Notifikácia pre voliteľov">
                        <div class="flex" @click="saveNotification">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                            </svg>
                            <span v-text="notificationStatus"></span>
                        </div>
                    </a>

                    <!--  Position save button -->
                    <a class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       href="#"
                       title="Notifikácia pre voliteľov">
                        <div class="flex" @click="positionSaveButton = ! positionSaveButton">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M1 4h2v2H1V4zm4 0h14v2H5V4zM1 9h2v2H1V9zm4 0h14v2H5V9zm-4 5h2v2H1v-2zm4 0h14v2H5v-2z"/>
                            </svg>
                            <span>Zmeniť poradie</span>
                        </div>
                    </a>

                    <!-- Meeting Delete button-->
                    <div @click="deleteMeeting(meeting)"
                         class="cursor-pointer block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                         :href="'/meet/'+ meeting.id + '/' + meeting.slug + '/meeting/delete'"
                         title="Zmazať položku">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20">
                                <path
                                    d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                            </svg>
                            Odstrániť
                        </div>
                    </div>

                </slot>
            </nav-drop-down>
        </div>

        <div class="flex justify-between max-w-sm mb- text-xs mb-6">

            <a :href="'/meet/' + meeting.id + '/pdf/show'"
               class="border-orange-300 bg-orange-100 border-2 text-gray-600 px-1 rounded-sm"
               target="_blank">
                Pozvánka
            </a>


            <button class="bg-blue-600 text-gray-200 px-2 rounded-sm" v-if="positionSaveButton"
                    @click="savePosition">
                Uložiť zmeny
            </button>

            <!--  User-Meeting Presenter -->
            <div v-if="meeting.published">
                <button v-if="isUserPresent" @click="updateMeetingUser"
                        class="border-blue-300 bg-blue-100 border-2 text-gray-600 px-1 rounded-sm">
                    Prihlásený {{ user.last_name }} ({{ meetingUsers.length}})
                </button>

                <button v-else @click="storeMeetingUser"
                        class="border-green-300 bg-green-100 border-2 text-gray-600 px-1 rounded-sm">
                    Prezentovať sa ({{ meetingUsers.length}})
                </button>
            </div>

            <button v-if="$auth.can('council delete') && meeting.published" @click="resetMeetingUser"
                    class="border-red-300 bg-red-100 border-2 text-gray-600 px-1 rounded-sm">
                Nová prezentácia
            </button>
            <!-- End of User-Meeting Presenter -->
        </div>


        <draggable v-model="items">
            <transition-group>
                <div v-for="item in items" :key="item.id" class="odd:bg-gray-500 bg-white">
                    <item :item="item"></item>
                </div>
            </transition-group>
        </draggable>

    </div>

</template>

<script>
    import draggable from 'vuedraggable';
    import moment from 'moment';
    import navDropDown from '../modules/navigation/navDropDown';
    import {mapState} from 'vuex';
    import item from '../items/itemList';

    export default {
        props: ['pmeeting'],
        components: {item, navDropDown, draggable},
        data: function () {
            return {
                moment: require('moment'),
                positionSaveButton: false
            }
        },
        computed: {
            isUserPresent() {
                return this.meetingUsers.filter(value => value.id == this.user.id).length
            },
            notificationStatus() {
                return this.meeting.notification == null ? 'Pozvánka na zasadnutie' : moment(this.meeting.notification).format('DD. MM. YYYY, HH:mm');
            },
            ...mapState({
                meeting: state => state.meetings.meeting,
                meetingUsers: state => state.meetings.meetingUsers,
            }),

            items: {
                get() {
                    return this.$store.state.meetings.items
                },
                set(value) {
                    this.$store.commit('meetings/UPDATE_LIST', value)
                }
            }
        },

        created() {
            this.$store.dispatch('meetings/fetchMeeting', this.pmeeting.id);
        },
        methods: {
            resetMeetingUser() {
                this.$store.dispatch('meetings/deleteMeetingUser', {
                    id: this.meeting.id,
                })
            },
            updateMeetingUser() {
                this.$store.dispatch('meetings/updateMeetingUser', {
                    user: this.user.id,
                    id: this.meeting.id
                })
            },

            storeMeetingUser() {
                this.$store.dispatch('meetings/storeMeetingUser', {
                    user: this.user.id,
                    id: this.meeting.id
                })
            },

            deleteMeeting(meeting) {
                axios.delete('/meetings/' + meeting.id)
                    .then(
                        // window.location.reload();
                        window.location.href = '/zastupitelstva'
                    )
            },
            publishedMeeting: function (published) {
                this.$store.dispatch('meetings/update', {
                    published: published,
                    id: this.meeting.id
                })
            },

            saveNotification() {
                if (!this.meeting.published) {
                    alert('Zasadnutie nie je publikované. Najprv zapnite publikovanie!')
                }
                this.$store.dispatch('meetings/update', {
                    notification: new Date().toISOString().slice(0, 19).replace('T', ' '),
                    id: this.meeting.id
                });

            },
            savePosition() {
                this.items.forEach((item, key) => {
                    console.log('Key ' + key + ' ' + item.name);
                });

                let postData = {};
                postData.items = this.items.map(item => {
                    return {
                        id: item.id
                    }
                });

                axios.put('/item/position/slug/item/position', postData)
                    .then(response => console.log('response', response));

                this.positionSaveButton = !this.positionSaveButton;
            }

        }

    }
</script>
<style>
    [v-cloak] {
        display: none;
    }
</style>
