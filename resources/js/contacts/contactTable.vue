<template>
    <div>

        <div class="flex justify-between max-w-4xl py-5">
            <h1 class="page-title">Zoznam dodávateľov</h1>
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
                <td class="px-4 py-2 border" v-text="contact.psc"></td>
                <td class="px-4 py-2 border" v-text="contact.ico"></td>
                <td class="px-4 py-2 border" v-text="contact.dic"></td>
                <td class="px-4 py-2 border" v-text="contact.email"></td>
                <td class="px-4 py-2 border" v-text="contact.phone"></td>
                <td class="px-4 py-2 border">
                    <a :href="'/org/' + contact.id + '/'  + contact.slug + '/contact/edit'">Edit</a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {
        props: ['contacts', 'organization'],
        data: function () {
            return {
                name: false,
                urlNewContact: '/org/' + this.organization.id + '/' + this.organization.slug + '/contact/create',
//                urlEditContact: '/org/' + this.contact.id + '/'  + this.contact.slug + '/contact/edit',
            }
        },
        methods: {
            toggle: function () {
                this.name = !this.name;
            }
        }
    }
</script>

<style lang="scss">

</style>

