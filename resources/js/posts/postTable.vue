<template>
    <div>
        <div class="flex justify-between">
            <div class="flex items-center">
                <search-form @emitForm="searchForm"></search-form>

                <div
                    class="lable-default lable-red px-2 mr-1 ml-3 flex"
                    v-if="contactName"
                >
                    <span>{{ contactName }}</span>
                    <div
                        class="
                            cursor-pointer
                            ml-3
                            text-gray-300
                            hover:text-gray-400
                        "
                        @click="clearContactSearch"
                    >
                        <span class="text-sm">X</span>
                    </div>
                </div>
                <div
                    class="
                        font-semibold
                        bg-green-700
                        text-gray-100
                        rounded-md
                        px-2
                        mr-1
                        ml-3
                        flex
                    "
                    v-if="categoryName"
                >
                    <span>{{ categoryName }}</span>
                    <div
                        class="
                            cursor-pointer
                            ml-3
                            text-gray-300
                            hover:text-gray-400
                        "
                        @click="clearCategorySearch"
                    >
                        <span class="text-sm">X</span>
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
                    <th class="table-header">Dátum</th>
                    <th class="table-header">Popis</th>
                    <th class="table-header">Kategória</th>
                    <th class="table-header">Dodávateľ</th>
                    <th class="table-header">Cena spolu</th>
                    <th class="table-header">Súbor</th>
                    <th class="table-header">Int. číslo</th>
                    <th class="table-header">Panel</th>
                </tr>
            </thead>
            <tbody>
                <post-table-item
                    :post="post"
                    v-for="post in posts.data"
                    :key="post.id"
                    @searchByCategory="searchByCategory"
                    @searchByContact="searchByContact"
                ></post-table-item>
            </tbody>
        </table>

        <paginator :data="posts" @pathUrl="changePaginateUrl" />
    </div>
</template>
<script>
import postTableItem from "./postTableItem.vue";
import searchForm from "../components/SearchForm";
import paginator from "../modules/pagination";

import { mapState, mapGetters } from "vuex";
import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("posts");

export default {
    components: { paginator, searchForm, postTableItem },

    data: function () {
        return {
            search: "",
            contactName: "",
            categoryName: "",
            year: new Date().getFullYear(),
            url:
                "/api/organizations/" +
                this.user.active_organization +
                "/posts",
        };
    },

    computed: {
        ...mapGetters("organizations", ["orgPosts"]),
        ...mapState("posts", ["posts"]),
    },
    created() {
        this.fetchPosts(this.url);
    },

    watch: {
        search: function (val) {
            this.fetchPosts(this.url + "?name=" + this.search);
        },

        year: function (val) {
            this.fetchPosts(this.url + "?year=" + this.year);
        },
    },

    methods: {
        ...mapActions(["fetchPosts"]),
        searchByContact: function (contact) {
            this.fetchPosts(this.url + "?contact=" + contact.id);
            this.contactName = contact.name;
        },
        searchByCategory: function (category) {
            this.fetchPosts(this.url + "?category=" + category.id);
            this.categoryName = category.name;
        },

        clearContactSearch: function () {
            this.fetchPosts(this.url);
            this.contactName = "";
        },

        clearCategorySearch: function () {
            this.fetchPosts(this.url);
            this.categoryName = "";
        },

        changePaginateUrl(path) {
            this.url = path;
            this.fetchPosts(this.url);
        },

        searchForm(val) {
            this.search = val;
        },
    },
};
</script>
