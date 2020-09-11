<template>
    <div>

        <div class="flex justify-between py-5">
            <h1 class="page-title">Zoznam dodávateľov</h1>

            <button @click="newContactToggle" class="btn btn-primary">
                Nový kontakt
            </button>
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
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Tel.</th>
                <th class="px-4 py-2">Panel</th>
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
                <td class="px-4 py-2 border"><a href="mailto: contact.email">{{ contact.email }}</a></td>
                <td class="px-4 py-2 border whitespace-no-wrap"><a href="tel: contact.phone">{{ contact.phone }}</a></td>
                <td class="px-4 py-2 border">
                    <!--                    :href="'/contact/edit/' + contact.id"-->
                    <a

                        class="hover:underline cursor-pointer" @click="openEditForm(contact)">Edit</a>
                </td>
            </tr>
            </tbody>
        </table>

        <paginator :data="contacts"/>

    </div>
</template>

<script>
    import paginator from '../modules/pagination';
    import numeral from 'numeral';
    import {mapState} from 'vuex';


    import { createNamespacedHelpers } from 'vuex';
    const { mapActions } = createNamespacedHelpers('contacts');

    export default {
        components: { paginator },
        data: function () {
            return {
                numeral: numeral,
                search: '',
                user: this.user,
                url: '/api/contacts/' + this.user.active_organization + '/'
            }
        },
        computed: mapState({
            contacts: state => state.contacts.contacts,
        }),
        mounted() {
            this.$store.dispatch('contacts/fetchContacts', this.url);
        },
        watch: {
            search: function (val) {
                this.$store.dispatch('contacts/fetchContacts', this.url + '?multi=' + this.search);
            }
        },
        methods: {
            ...mapActions([
                'newContactToggle',
                'openEditForm',
                'filterContact'
            ]),

            getContacts: function () {
                axios.get(this.url + this.search)
                    .then(response => {
                            this.contacts = response.data.data;
                            this.makePagination(response.data)
                        }
                    );
            }
        },
        filters: {
            pscFormat: function (value) {
                return value.toString().replace(/\B(?=(\d{0})+(?!\d))/g, " ");
            }
        }
    }
</script>

<style lang="scss">

</style>

