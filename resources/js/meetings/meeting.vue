<template>
    <div class="mb-6">

        <div class="flex justify-between max-w-sm">
            <!--            <h1 class="page-title">{{ meeting.name }}</h1>-->
            <div class="">
                <span class="text-gray-700">Začiatok: {{ moment(meeting.start_at).format('DD. MM. YYYY') }}</span>
                <strong>{{ moment(meeting.start_at).format('h:mm') }} hod.</strong>
            </div>

            <nav-drop-down>
                <slot>
                    <div class="py-1">
                        <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       :href="'/item/'+ meeting.id + '/' + meeting.slug + '/create'"
                       title="Vytvoriť nové zasadnutie">
                        Nový bod
                    </a>
                    </div>

                    <!--  Poslať všetkým notifikáciu -->
                    <a class="whitespace-no-wrap block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                       href="#"
                       title="Notifikácia pre voliteľov">
                        <div class="flex">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
                            </svg>
                            Pozvánka učastníkom
                        </div>

                    </a>
                </slot>
            </nav-drop-down>
        </div>

        <div v-for="item in items" :key="item.id" class="odd:bg-gray-500 mt-4 bg-white">
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
        props: ['meeting'],
        components: {item, navDropDown},
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: mapState({
            items: state => state.meetings.items,
        }),
        created() {
            this.$store.dispatch('meetings/fetchMeeting', this.meeting.id);
        },
        methods: {}

    }
</script>
