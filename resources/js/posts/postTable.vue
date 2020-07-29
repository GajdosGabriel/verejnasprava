<template>
    <table class="table-auto table-bordered text-sm">
        <thead>
        <tr class="bg-gray-300">
            <th class="px-4 py-2">Dátum</th>
            <th class="px-4 py-2">Popis</th>
            <th class="px-4 py-2">Kategória</th>
            <th class="px-4 py-2">Dodávateľ</th>
            <th class="px-4 py-2">Cena spolu</th>
            <th class="px-4 py-2">Súbor</th>
            <th class="px-4 py-2">Int. číslo</th>
            <th class="px-4 py-2">Panel</th>
        </tr>
        </thead>
        <tbody>

        <tr class="hover:bg-gray-100" v-for="post in posts" :key="post.id">
            <td class="border px-4 py-2 whitespace-no-wrap" v-text="moment(post.date_in).format('L')"></td>
            <td class="border px-4 py-2" v-text="post.name"></td>
            <td class="border px-4 py-2" v-text="post.category.name"></td>
            <td class="border px-4 py-2" v-text="post.contact.name"></td>
            <td class="border px-4 py-2 whitespace-no-wrap">{{ post.price | priceFormat }} Eu</td>
            <td class="border px-4 py-2">
                <span v-if="post.files.length > 0">
                    <div v-for="file in post.files">
                    <a target="_blank" :href="'/pdf/' + file.id + '/' + file.name + '/download/pdf'">Príloha</a>
                    </div>
               </span>
               <span v-else>Bez prílohy</span>
            </td>

            <td class="border px-4 py-2" v-text="post.int_number"></td>

            <td class="border px-4 py-2 cursor-pointer" @click="adminPanel = post.id">
                <div v-if="adminPanel == post.id">Items</div>
                <div v-else class="mx-auto">...</div>
            </td>

        </tr>

        </tbody>
    </table>
</template>
<script>
    import moment from 'moment';
    import numeral from 'numeral';

    export default {
        data: function () {
            return {
                posts: [],
                user: this.user,
                moment: moment,
                adminPanel: false
            }
        },

        created() {
            this.getPosts();
        },

        methods: {
            getPosts: function () {
                axios.get('/api/posts/index/' + this.user.active_organization)
                    .then(response => {
                        this.posts = response.data.data
                    })
            }
        },

        filters: {
            priceFormat: function (value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>
