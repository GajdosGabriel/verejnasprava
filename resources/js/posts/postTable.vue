<template>
    <div>
        <input type="text" v-model="search" placeholder="hľadať v popis, cena" class="p-1 focus:border-purple-500">
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

        <div class="flex justify-center my-10 space-x-3">
            <button @click="fetchPaginate(pagination.prev_page_url)"
                    class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-600 border-2 border-black rounded-sm cursor-pointer"
                    :disabled="! pagination.prev_page_url"> <<
            </button>
            <div
                class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-600 border-2 border-gray-700 rounded-sm">
                {{ pagination.current_page}} / {{ pagination.last_page}}
            </div>
            <button @click="fetchPaginate(pagination.next_page_url)"
                    class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-600 border-2 border-black rounded-sm cursor-pointer"
                    :disabled="! pagination.next_page_url"> >>
            </button>
        </div>
    </div>

</template>
<script>
    import moment from 'moment';
    import numeral from 'numeral';

    export default {
        data: function () {
            return {
                posts: [],
                pagination: [],
                user: this.user,
                moment: require('moment'),
                adminPanel: false,
                search: '',
                url: '/api/posts/' + this.user.active_organization + '/'
            }
        },

        created() {
            this.getPosts();
        },
        watch: {
          search: function (val) {
              this.getPosts();
          }
        },
        methods: {
            getPosts: function () {
                axios.get(this.url + this.search)
                    .then(response => {
                        this.posts = response.data.data;
                        this.makePagination(response.data);
                    })
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
                this.getPosts()
            }
        },

        filters: {
            priceFormat: function (value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>
