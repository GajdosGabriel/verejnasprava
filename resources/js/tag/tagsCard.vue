<template>
    <div class="flex flex-wrap">
        <tag-form />
        <div class="block">
            <div v-for="tag in tags" :key="tag.id">
                <tag-item :tag="tag"></tag-item>
            </div>
        </div>
    </div>
</template>

<script>
import tagItem from "./tag-Item";
import tagForm from "./tagForm";

export default {
    components: { tagItem, tagForm },
    data() {
        return {
            hover: false,
            tags: {}
        };
    },
    created() {
        this.getTags();
    },
    methods: {
        getTags() {
            axios.get("/api/organizations/1/tags").then(response => {
                this.tags = response.data;
            });
        }
    }
};
</script>
