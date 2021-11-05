<template>
    <div>
        <div class="flex justify-between">
            <div class="flex items-center">
                <search-form @emitForm="searchForm"></search-form>

                <div
                    class="font-semibold bg-red-700 text-gray-100 rounded-md px-2 mr-1 ml-3 flex"
                    v-if="contactName"
                >
                    <span>{{ contactName }}</span>
                    <div
                        class="cursor-pointer ml-3 text-gray-300 hover:text-gray-400"
                        @click="clearContactSearch"
                    >
                        <span class=" text-sm">X</span>
                    </div>
                </div>
                <div
                    class="font-semibold bg-green-700 text-gray-100 rounded-md px-2 mr-1 ml-3 flex"
                    v-if="categoryName"
                >
                    <span>{{ categoryName }}</span>
                    <div
                        class="cursor-pointer ml-3 text-gray-300 hover:text-gray-400"
                        @click="clearCategorySearch"
                    >
                        <span class=" text-sm">X</span>
                    </div>
                </div>
            </div>

            <div>
                <label>Rok</label>
                <select v-model="year">
                    <option
                        :value="year.year"
                        v-for="(year, index) in orgPosts"
                        :key="index"
                        v-text="year.year"
                    ></option>
                    <!-- <option value="2021">2021</option> -->
                    <!-- <option value="2020">2020</option> -->
                    <!-- <option value="2019">2019</option> -->
                </select>
            </div>
        </div>

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
                        class="border px-4 py-2 cursor-pointer"
                        v-text="post.category.name"
                        @click="searchByCategory(post.category)"
                    ></td>
                    <td
                        class="border px-4 py-2 whitespace-no-wrap cursor-pointer"
                        v-text="post.contact.name"
                        @click="searchByContact(post.contact)"
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

                    <td class="border text-center">
                        <drop-down-component
                            :navigations="post.navigations"
                            @fromItem="clickOnItem"
                        ></drop-down-component>
                    </td>
                </tr>
            </tbody>
        </table>

        <paginator :data="posts" @pathUrl="changePaginateUrl" />

        <notification-list></notification-list>
    </div>
</template>
<script>
import searchForm from "../components/SearchForm";
import paginator from "../modules/pagination";
import dropDownComponent from "../components/dropDown/dropDownComponent";
import { filterMixin } from "../mixins/filterMixin";

import { mapState, mapGetters } from "vuex";
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("posts");

export default {
    components: { paginator, dropDownComponent, searchForm },
    mixins: [filterMixin],
    data: function() {
        return {
            moment: require("moment"),
            search: "",
            contactName: "",
            categoryName: "",
            year: new Date().getFullYear(),
            url:
                "/api/organizations/" + this.user.active_organization + "/posts"
        };
    },

    computed: {
        ...mapGetters("organizations", ["orgPosts"]),
        ...mapState("posts", ["posts"])
    },
    created() {
        this.fetchPosts(this.url);
    },

    watch: {
        search: function(val) {
            this.fetchPosts(this.url + "?name=" + this.search);
        },

        year: function(val) {
            this.fetchPosts(this.url + "?year=" + this.year);
        }
    },

    methods: {
        ...mapActions(["fetchPosts", "editPost", "deletePost"]),

        searchByContact: function(contact) {
            this.fetchPosts(this.url + "?contact=" + contact.id);
            this.contactName = contact.name;
        },
        searchByCategory: function(category) {
            this.fetchPosts(this.url + "?category=" + category.id);
            this.categoryName = category.name;
        },

        clearContactSearch: function() {
            this.fetchPosts(this.url);
            this.contactName = "";
        },

        clearCategorySearch: function() {
            this.fetchPosts(this.url);
            this.categoryName = "";
        },

        clickOnItem(post, action) {
            if (action == "edit") {
                this.editPost(post);
            }

            if (action == "delete") {
                this.deletePost(post);
            }
        },

        changePaginateUrl(path) {
            this.url = path;
            this.fetchPosts(this.url);
        },

        searchForm(val) {
            this.search = val;
        }
    }
};
</script>
