<template>
    <tr class="hover:bg-gray-100">
        <td
            class="table-data whitespace-no-wrap"
            v-text="moment(post.date_in).format('DD. MM. YYYY')"
        ></td>
        <td class="table-data" v-text="post.name"></td>
        <td
            class="table-data cursor-pointer"
            v-text="post.category.name"
            @click="$emit('searchByCategory', post.category)"
        ></td>
        <td
            class="table-data whitespace-no-wrap cursor-pointer"
            v-text="post.contact.name"
            @click="$emit('searchByContact', post.contact)"
        ></td>
        <td class="table-data whitespace-no-wrap">
            {{ post.price | priceFormat }} Eu
        </td>
        <td class="table-data">
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
            <span v-else class="whitespace-no-wrap">Bez prílohy</span>
        </td>

        <td class="table-data" v-text="post.int_number"></td>

        <td class="border text-center">
            <drop-down-component
                :items="post"
                @fromItem="clickOnItem"
            ></drop-down-component>
        </td>
    </tr>
</template>
<script>
import { filterMixin } from "../mixins/filterMixin";
import dropDownComponent from "../components/dropDown/dropDownComponent";

import { createNamespacedHelpers } from "vuex";
const { mapActions } = createNamespacedHelpers("posts");
export default {
    props: ["post"],
    components: { dropDownComponent },
    mixins: [filterMixin],

    data: function () {
        return {
            moment: require("moment"),
        };
    },

    methods: {
        ...mapActions(["editPost", "deletePost"]),
        
        clickOnItem(action, post) {
            if (action == "edit") {
                this.editPost(post.navigations.edit.url);
            }

            if (action == "delete") {
                this.deletePost(post.navigations.delete.url);
            }
        },
    },
};
</script>
