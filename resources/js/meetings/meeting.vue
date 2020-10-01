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
    import item from '../items/item';

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
            authUser: state => state.meetings.authUser
        }),
        created() {
            this.$store.dispatch('meetings/fetchMeeting', this.meeting.id);
            this.$store.commit('meetings/SET_AUTHUSER', this.user, {root: true})
        },
        methods: {}

    }
</script>
