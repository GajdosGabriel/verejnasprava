<template>
    <div class="mb-6">
        <div class="">
            <h1 class="page-title">{{ meeting.name }}</h1>
            <div>
                <span class="text-gray-700">Začiatok: {{ moment(meeting.start_at).format('DD. MM. YYYY') }}</span>
                <strong>{{ moment(meeting.start_at).format('h:mm') }} hod.</strong>
            </div>
        </div>

        <div class="mt-4 bg-white">
            <div v-for="item in items" :key="item.id" class="odd:bg-gray-500">

                <item :item="item"></item>

            </div>
        </div>

    </div>

</template>

<script>
    import moment from 'moment';
    import {mapState} from 'vuex';
    import item from '../items/item';

    export default {
        props: ['meeting'],
        components: {item},
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: mapState({
            items: state => state.items.items
        }),
        created() {
            this.$store.dispatch('items/set_items', this.meeting);
        },
        methods: {}

    }
</script>
