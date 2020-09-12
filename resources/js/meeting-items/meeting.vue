<template>
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="page-title">{{ meeting.name }}</h1>
            <div>
                <span class="text-gray-700">Začiatok: {{ moment(meeting.start_at).format('DD. MM. YYYY') }}</span>
                <strong>{{ moment(meeting.start_at).format('h:mm') }} hod.</strong>
            </div>
        </div>

        <div class="mt-4 bg-white hover:bg-gray-100 p-2 odd:bg-gray-500">
            <div class="flex justify-between flex-wrap mt-2 mb-5">

                <h5 class="font-semibold mb-4">
                    <div  v-for="item in items" :key="item.id">
                        <item :item="item"></item>
                    </div>
                </h5>

            </div>
        </div>
    </div>

</template>

<script>
    import moment from 'moment';
    import { mapState } from 'vuex';
    import item from './item';


    export default {
        props: ['meeting'],
        components:{ item },
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: mapState ({
            items: state => state.meetingItems.items
        }),
        created() {
            this.$store.dispatch('meetingItems/set_items', this.meeting);
        },
        methods: {
        }

    }
</script>
