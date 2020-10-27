<template>
    <div>
        <div v-text="" class="p-1 border-2 rounded-lg bg-red-500 cursor-pointer text-sm text-gray-200 w-auto inline-block " v-if="search !== ''" @click="search = ''">
            {{ search }}
            <span class="ml-3 mr-2">X</span>
        </div>
<!--        <input type="text" v-model="search" placeholder="hľadať v popise" class="p-1 focus:border-purple-500 border-gray-200 border-2 rounded-sm">-->
<!--        <span @click="search = ''" class="cursor-pointer text-gray-500" v-if="search !== ''" >X</span>-->

        <table class="table-auto table-bordered text-sm w-full">
            <thead>
            <tr class="bg-gray-300">
                <th class="px-4 py-2">Dátum</th>
                <th class="px-4 py-2">Organizácia</th>
                <th class="px-4 py-2">Popis</th>
                <th class="px-4 py-2">Kategória</th>
                <th class="px-4 py-2">Dodávateľ</th>
                <th class="px-4 py-2">Cena spolu</th>
                <th class="px-4 py-2">Súbor</th>
                <th class="px-4 py-2">Int. číslo</th>
            </tr>
            </thead>
            <tbody>

            <tr class="hover:bg-gray-100" v-for="post in posts.data" :key="post.id">
                <td class="border px-4 py-2 whitespace-no-wrap" v-text="moment(post.date_in).format('DD. MM. YYYY')"></td>
                <td class="border px-4 py-2 whitespace-no-wrap cursor-pointer" v-text="post.organization.name" @click="pushOrganization(post)"></td>
                <td class="border px-4 py-2" v-text="post.name"></td>
                <td class="border px-4 py-2" v-text="post.category.name"></td>
                <td class="border px-4 py-2 whitespace-no-wrap" v-text="post.contact.name"></td>
                <td class="border px-4 py-2 whitespace-no-wrap">{{ post.price | priceFormat }} Eu</td>
                <td class="border px-4 py-2">
                <span v-if="post.files.length > 0">
                    <div v-for="file in post.files">
                    <a target="_blank" :href="'/pdf/' + file.id + '/' + file.filename + '/download/pdf'">Príloha</a>
                    </div>
               </span>
                    <span v-else class="whitespace-no-wrap">Bez prílohy</span>
                </td>

                <td class="border px-4 py-2" v-text="post.int_number"></td>
            </tr>

            </tbody>
        </table>

        <div v-if="loadingStatus" class="w-ful flex mt-8 justify-center">
            <svg class="animate-spin h-5 w-5 mr-3 text-gray-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path d="M14.66 15.66A8 8 0 1 1 17 10h-2a6 6 0 1 0-1.76 4.24l1.42 1.42zM12 10h8l-4 4-4-4z"/>
            </svg>
        </div>


        <paginator :data="posts" :url="url"/>

    </div>

</template>
<script>
    import paginator from '../modules/pagination';
    import {mapState} from 'vuex';

    export default {
        components: { paginator },
        data: function () {
            return {
                moment: require('moment'),
                adminPanel: false,
                search: ''
            }
        },

        computed: mapState ({
            loadingStatus: state => state.posts.loadingStatus,
            posts: state => state.posts.posts,
            url: state => state.posts.urlPostFront
        }),

        created() {
          this.$store.dispatch('posts/frontedPosts', this.url);
        },

        watch: {
          search: function (val) {
              this.$store.dispatch('posts/frontedPosts', this.url + '?organization=' + this.search);
          }
        },
        methods: {
            pushOrganization(post){
                this.search = post.organization.name
            }
        },

        filters: {
            priceFormat: function (value) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            }
        }
    }
</script>

<style>

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
