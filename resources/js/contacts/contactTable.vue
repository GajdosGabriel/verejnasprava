<template>
    <div>

        <div class="flex justify-between py-5">
            <h1 class="page-title">Kontakty</h1>

            <new-contact-button/>

        </div>

        <input type="text" v-model="search" class="p-1 border-2 border-gray-300 rounded-sm"
               placeholder="Name, email, phone, city">
        <span @click="search = ''" class="cursor-pointer text-gray-500" v-if="search !== ''">X</span>

        <table class="table-auto w-full">
            <thead>
            <tr class="bg-gray-300">
                <th class="px-4 py-2 whitespace-no-wrap">Názov firmy</th>
                <th class="px-4 py-2">Ulica</th>
                <th class="px-4 py-2">Mesto</th>
                <th class="px-4 py-2">Psč</th>
                <th class="px-4 py-2">Ičo</th>
                <th class="px-4 py-2">Dič</th>
                <th class="px-4 py-2"  v-if="$auth.isAdmin()">Email</th>
                <th class="px-4 py-2">Tel.</th>
                <th class="px-4 py-2"  v-if="$auth.isAdmin()">Panel</th>
            </tr>
            </thead>
            <tbody>
            <tr class="hover:bg-gray-200" v-for="contact in contacts.data">
                <td class="px-4 py-2 border" v-text="contact.name"></td>
                <td class="px-4 py-2 border" v-text="contact.street"></td>
                <td class="px-4 py-2 border whitespace-no-wrap" v-text="contact.city"></td>
                <td class="px-4 py-2 border whitespace-no-wrap">{{ contact.psc | pscFormat }}</td>
                <td class="px-4 py-2 border" v-text="contact.ico"></td>
                <td class="px-4 py-2 border" v-text="contact.dic"></td>
                <td class="px-4 py-2 border"   v-if="$auth.isAdmin()"><a href="mailto: contact.email">{{ contact.email }}</a></td>
                <td class="px-4 py-2 border whitespace-no-wrap"><a href="tel: contact.phone">{{ contact.phone }}</a></td>
                <td class="px-4 py-2 border text-center"  v-if="$auth.isAdmin()">
                    <button class="hover:underline cursor-pointer text-sm" @click="openEditForm(contact)">Upraviť</button>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :data="contacts"/>

        <form-edit></form-edit>

    </div>
</template>

<script>

    import newContactButton from './newContactButton.vue';
    import formEdit from './formEdit.vue';
    import paginator from './pagination.vue';
    import numeral from 'numeral';
    import {mapState} from 'vuex';
    import { filterMixin} from "../mixins/filterMixin";

    import { createNamespacedHelpers } from 'vuex';

    const { mapActions } = createNamespacedHelpers('contacts');

    export default {
        components: {paginator, formEdit, newContactButton },
        mixins: [filterMixin],
        data: function () {
            return {
                numeral: numeral,
                search: ''
            }
        },
        computed: mapState({
            contacts: state => state.contacts.contacts,
            url: state => state.contacts.url
        }),
        created() {
            this.$store.dispatch('contacts/fetchContacts', this.url  + this.user.active_organization);
        },
        watch: {
            search: function (val) {
                console.log('dddd');
                this.$store.dispatch('contacts/fetchContacts', this.url + this.user.active_organization + '?multi=' + this.search);
            }
        },
        methods: {
            ...mapActions([
                'newContactToggle',
                'openEditForm',
                'filterContact'
            ])
        }
    }
</script>

<style lang="scss">

</style>

