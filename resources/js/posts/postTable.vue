<template>
    <div>
        <input type="text" v-model="search" placeholder="hľadať v popise" class="p-1 focus:border-purple-500 border-gray-200 border-2 rounded-sm">
        <span @click="search = ''" class="cursor-pointer text-gray-500" v-if="search !== ''" >X</span>

        <table class="table-auto table-bordered text-sm w-full">
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

            <tr class="hover:bg-gray-100" v-for="post in posts.data" :key="post.id">
                <td class="border px-4 py-2 whitespace-no-wrap" v-text="moment(post.date_in).format('DD. MM. YYYY')"></td>
                <td class="border px-4 py-2" v-text="post.name"></td>
                <td class="border px-4 py-2" v-text="post.category.name"></td>
                <td class="border px-4 py-2 whitespace-no-wrap cursor-pointer" v-text="post.contact.name" @click="searchByContact(post.contact.name)"></td>
                <td class="border px-4 py-2 whitespace-no-wrap">{{ post.price | priceFormat }} Eu</td>
                <td class="border px-4 py-2">
                <span v-if="post.files.length > 0">
                    <div v-for="file in post.files">
                    <a target="_blank" :href="'/pdf/' + file.id + '/' + file.name + '/download/pdf'">Príloha</a>
                    </div>
               </span>
                    <span v-else class="whitespace-no-wrap">Bez prílohy</span>
                </td>

                <td class="border px-4 py-2" v-text="post.int_number"></td>

                <td class="border px-4 py-2 cursor-pointer flex flex-col" @click="adminPanel = post.id">
                    <ul v-if="adminPanel == post.id"  class="dropdown-menu absolute text-gray-700 p-2
                    border-gray-400 bg-white border-2 rounded-sm">
                        <li class="mb-2"><a :href="'post/edit/' + post.id"  class="hover:underline">Upraviť</a></li>
                        <li><a :href="'post/delete/' + post.id"  class="hover:underline">Zmazať</a></li>
                        </ul>
                    <div v-else class="mx-auto">...</div>
                </td>

            </tr>

            </tbody>
        </table>

        <paginator :data="posts"/>

    </div>

</template>
<script>
    import paginator from '../modules/pagination';
    import moment from 'moment';
    import numeral from 'numeral';
    import { mapState } from 'vuex';

    export default {
        components: { paginator },
        data: function () {
            return {
                user: this.user,
                moment: require('moment'),
                adminPanel: false,
                search: '',
                url: '/api/posts/' + this.user.active_organization
            }
        },

        computed: mapState ({
            posts: state => state.posts.posts
        }),

        created() {
          this.$store.dispatch('posts/fetchPosts', this.url);
        },

        watch: {
          search: function (val) {
              this.$store.dispatch('posts/fetchPosts', this.url + '?name=' + this.search);
          }
        },
        methods: {
            fetchPaginate: function (url) {
                this.url = url;
                this.getPosts()
            },
            searchByContact: function(contact){
                this.search = contact;
            }
        },

        filters: {
            priceFormat: function (value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>
