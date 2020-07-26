<template>
    <div>

        <div class="flex justify-between max-w-4xl py-5">
            <h1 class="page-title">Zoznam dodávateľov</h1>

            <input type="text" v-model="search" class="px-3 text-sm border-2 border-gray-300 rounded-sm"
                   placeholder="Name, emial, phone, city">
            <a :href="urlNewContact" class="btn btn-primary">Nový kontakt</a>
        </div>


        <table class="table-auto">
            <thead>
            <tr class="bg-gray-300">
                <th class="px-4 py-2">Názov firmy</th>
                <th class="px-4 py-2">Adresa</th>
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
                <td class="px-4 py-2 border" v-text="contact.city"></td>
                <td class="px-4 py-2 border whitespace-no-wrap">{{ contact.psc | pscFormat }}</td>
                <td class="px-4 py-2 border" v-text="contact.ico"></td>
                <td class="px-4 py-2 border" v-text="contact.dic"></td>
                <td class="px-4 py-2 border" v-text="contact.email"></td>
                <td class="px-4 py-2 border" v-text="contact.phone"></td>
                <td class="px-4 py-2 border">
                    <a :href="'/contact/edit/' + contact.id">Edit</a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    import numeral from 'numeral';
    export default {
        // props: ['organization'],
        data: function () {
            return {
                name: false,
                contacts: [],
                numeral: numeral,
                search: '',
                user: this.user,
                urlNewContact: '/contact/create/' + this.user.active_organization,
                // urlEditContact: '/org/' + this.contact.id + '/'  + this.contact.slug + '/contact/edit',
            }
        },
        created() {
            this.getContacts();
        },
        watch: {
            search: function (val) {
                this.getContacts();
            }
        },
        methods: {
            toggle: function () {
                this.name = !this.name;
            },

            getContacts: function () {
                let $this = this;
                axios.get('/api/contacts/' + this.user.active_organization + '/' + this.search)
                    .then(response => {
                            this.contacts = response.data
                            // this.makePagination(response.data)
                        }
                    );
            },
        },
        filters: {
            pscFormat: function(value){
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>

<style lang="scss">

</style>

