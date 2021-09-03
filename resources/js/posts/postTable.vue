<template>
    <div>
        <input
            type="text"
            v-model="search"
            placeholder="hľadať v popise"
            class="p-1 focus:border-purple-500 border-gray-200 border-2 rounded-sm"
        />
        <span
            @click="search = ''"
            class="cursor-pointer text-gray-500"
            v-if="search !== ''"
            >X</span
        >

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
                <tr
                    class="hover:bg-gray-100"
                    v-for="post in posts.data"
                    :key="post.id"
                >
                    <td
                        class="border px-4 py-2 whitespace-no-wrap"
                        v-text="moment(post.date_in).format('DD. MM. YYYY')"
                    ></td>
                    <td class="border px-4 py-2" v-text="post.name"></td>
                    <td
                        class="border px-4 py-2"
                        v-text="post.category.name"
                    ></td>
                    <td
                        class="border px-4 py-2 whitespace-no-wrap cursor-pointer"
                        v-text="post.contact.name"
                        @click="searchByContact(post.contact.id)"
                    ></td>
                    <td class="border px-4 py-2 whitespace-no-wrap">
                        {{ post.price | priceFormat }} Eu
                    </td>
                    <td class="border px-4 py-2">
                        <span v-if="post.files.length > 0">
                            <div v-for="file in post.files" :key="file.id">
                                <a
                                    target="_blank"
                                    :href="
                                        '/file/' +
                                            file.id +
                                            '/' +
                                            file.filename +
                                            '/file/show'
                                    "
                                    >Príloha</a
                                >
                            </div>
                        </span>
                        <span v-else class="whitespace-no-wrap"
                            >Bez prílohy</span
                        >
                    </td>

                    <td class="border px-4 py-2" v-text="post.int_number"></td>

                    <td
                        class="border px-4 py-2 cursor-pointer flex flex-col"
                        @click="adminPanel = post.id"
                    >
                        <nav-drop-down>
                            <slot>
                                <div class="py-1">
                                    <a
                                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                                        :href="'posts/' + post.id + '/edit'"
                                        title="Upraviť položku"
                                    >
                                        Upraviť
                                    </a>

                                    <div
                                        @click="deletePost(post)"
                                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                                        title="Zmazať položku"
                                    >
                                        Zmazať
                                    </div>
                                </div>
                            </slot>
                        </nav-drop-down>
                    </td>
                </tr>
            </tbody>
        </table>

        <paginator :data="posts" @pathUrl="changePaginateUrl" />
        <!-- <paginator :data="posts"/> -->
    </div>
</template>
<script>
import paginator from "../modules/pagination";
import { mapState } from "vuex";
import { filterMixin } from "../mixins/filterMixin";

import { createNamespacedHelpers } from "vuex";

const { mapActions } = createNamespacedHelpers("posts");

export default {
    components: { paginator },
    mixins: [filterMixin],
    data: function() {
        return {
            moment: require("moment"),
            adminPanel: false,
            search: "",
            url:
                "/api/organizations/" + this.user.active_organization + "/posts"
        };
    },

    computed: mapState({
        posts: state => state.posts.posts
    }),

    created() {
        this.fetchPosts(this.url);
    },

    watch: {
        search: function(val) {
            this.fetchPosts(this.url + "?contact=" + this.search);
        }
    },

    methods: {
        ...mapActions(["fetchPosts"]),

        searchByContact: function(contactId) {
            this.prefix = "contact";
            this.search = contactId;
        },

        deletePost: function(post) {
            axios
                .delete("/api/organizations/" + this.user.active_organization + "/posts/" + post.id)
                .then(window.location.reload());
        },

        changePaginateUrl(path) {
            this.url = path;
            this.fetchPosts(this.url);
        }
    }
};
</script>
