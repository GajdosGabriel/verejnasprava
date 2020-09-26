<template>
    <div>
        <div class="mb-4" v-for="council in councils">

            <div class="flex justify-between">
                <h1 class="page-title">{{ council.name }}</h1>
                <div class="flex">
                    Zasadaní ({{ council.meetings.length }})

                    <nav-drop-down>
                        <slot>
                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                               :href="'admin/'+ council.id + '/' + council.slug + '/edit/zast'"
                               title="Upraviť položku">
                                Upraviť položku
                            </a>

                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                               :href="'admin/'+ council.id + '/' + council.slug + '/council/delete'"
                               title="Zmazať zastupiteľstvo">
                                Zmazať
                            </a>
                        </slot>
                    </nav-drop-down>

                </div>

            </div>
            <div class="flex flex-col">
                <div class="flex justify-between hover:underline" v-for="meeting in council.meetings">

                    <a :href="'item/' + meeting.id +'/' + meeting.slug + '/index'">
                        <strong v-text="moment( meeting.start_at).format('DD. MM. YYYY')"></strong>
                        hod.
                        <strong>{{ meeting.name }}</strong>
                    </a>


                    <div class="cursor-pointer">
                        <a :href="'item/' + meeting.id +'/' + meeting.slug + '/index'">
                            Program ({{meeting.items.length }})
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import navDropDown from '../modules/navigation/navDropDown'

    export default {
        components: {navDropDown},
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: mapState({
            councils: state => state.councils.councils
        }),

        created() {
            this.$store.dispatch('councils/fetchConcils', 1)
        }
    }
</script>
