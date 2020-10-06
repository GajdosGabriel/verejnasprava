<template>
    <div>
        <div class="mb-4" v-for="council in councils">

            <div class="flex justify-between flex-wrap">
                <div class="flex whitespace-no-wrap items-center">
                    <h1 class="page-title">{{ council.name }}</h1>
                     <div class="ml-2" > ({{ council.meetings.length }})</div>
                </div>

                <div class="flex whitespace-no-wrap">
                    <nav-drop-down>
                        <slot>
                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                               :href="'meet/'+ council.id + '/' + council.slug + '/meeting/create'"
                               title="Vytvoriť nové zasadnutie">
                                Nové zasadnutie
                            </a>

                            <div class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                               title="Upraviť položku"
                                 @click="openForm(council)"
                            >
                                Upraviť položku
                            </div>

                            <a class="px-4 py-1 whitespace-no-wrap hover:bg-gray-200 text-left"
                               :href="'admin/'+ council.id + '/' + council.slug + '/council/delete'"
                               title="Zmazať zastupiteľstvo">
                                Zmazať
                            </a>
                        </slot>
                    </nav-drop-down>
                </div>

            </div>
            <div class="flex flex-col ">
                <div class="flex justify-between hover:underline flex-wrap" v-for="meeting in council.meetings">

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
        <edit-form></edit-form>
    </div>
</template>

<script>
    import {mapState} from 'vuex';
    import {createNamespacedHelpers} from 'vuex';
    const {mapActions} = createNamespacedHelpers('modals');
    import navDropDown from '../modules/navigation/navDropDown';
    import editForm from './modalEdit';

    export default {
        components: {navDropDown, editForm},
        data: function () {
            return {
                moment: require('moment'),
            }
        },
        computed: mapState({
            councils: state => state.councils.councils
        }),

        methods:{
            openForm: function (item) {
                this.$store.dispatch('modals/open_form',item)
            }
        },

        created() {
            this.$store.dispatch('councils/fetchConcils', this.user.active_organization)
        }
    }
</script>
