<template>
    <div>

        <div class="flex justify-between max-w-4xl py-5">
            <h1 class="page-title">Zoznam dodávateľov</h1>


            <a :href="'/contact/create/' + this.user.active_organization" class="btn btn-primary">Nový kontakt</a>
        </div>

        <input type="text" v-model="search" class="p-1 border-2 border-gray-300 rounded-sm"
               placeholder="Name, email, phone, city">
        <span @click="search = ''" class="cursor-pointer text-gray-500" v-if="search !== ''" >X</span>
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
            <tr class="hover:bg-gray-200" v-for="contact in contacts">
                <td class="px-4 py-2 border" v-text="contact.name"></td>
                <td class="px-4 py-2 border" v-text="contact.street"></td>
                <td class="px-4 py-2 border whitespace-no-wrap" v-text="contact.city"></td>
                <td class="px-4 py-2 border whitespace-no-wrap">{{ contact.psc | pscFormat }}</td>
                <td class="px-4 py-2 border" v-text="contact.ico"></td>
                <td class="px-4 py-2 border" v-text="contact.dic"></td>
                <td class="px-4 py-2 border" v-text="contact.email"></td>
                <td class="px-4 py-2 border whitespace-no-wrap" v-text="contact.phone"></td>
                <td class="px-4 py-2 border">
                    <a :href="'/contact/edit/' + contact.id" class="hover:underline">Edit</a>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="flex justify-center my-10 space-x-3">
            <button @click="fetchPaginate(pagination.prev_page_url)"
                    class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
                    :disabled="! pagination.prev_page_url"> <<
            </button>
            <div
                class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm">
                {{ pagination.current_page}} / {{ pagination.last_page}}
            </div>
            <button @click="fetchPaginate(pagination.next_page_url)"
                    class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
                    :disabled="! pagination.next_page_url"> >>
            </button>
        </div>

    </div>
</template>

<script>
    import numeral from 'numeral';
    export default {
        data: function () {
            return {
                name: false,
                pagination: [],
                numeral: numeral,
                search: '',
                user: this.user,
                url: '/api/contacts/' + this.user.active_organization + '/'
                // urlEditContact: '/org/' + this.contact.id + '/'  + this.contact.slug + '/contact/edit',
            }
        },
        computed: {
          contacts: function () {
            return this.$store.state.contacts.contacts;
          }
        },
        created() {
            this.$store.dispatch('contacts/loadContacts', this.url);
        },
        watch: {
            search: function (val) {
                this.$store.dispatch('contacts/loadContacts', this.url + '?multi=' + this.search);
            }
        },
        methods: {
            toggle: function () {
                this.name = !this.name;
            },

            getContacts: function () {
                axios.get(this.url + this.search)
                    .then(response => {
                            this.contacts = response.data.data;
                            this.makePagination(response.data)
                        }
                    );
            },

            makePagination: function (data) {
                let pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                };
                this.pagination = pagination;
            },
            fetchPaginate: function (url) {
                this.url = url;
                this.getContacts()
            }
        },
        filters: {
            pscFormat: function(value){
                return value.toString().replace(/\B(?=(\d{0})+(?!\d))/g, " ");
            }
        }
    }
</script>

<style lang="scss">

</style>

