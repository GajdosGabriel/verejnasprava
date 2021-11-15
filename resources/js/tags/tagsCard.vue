<template>
    <div>
        <card-header :item="'tag'" :title="'Nálepky'" @openCard="isOpen =! isOpen" />
        <tag-form v-if="isOpen" />
        <div v-if="isOpen">
            <div v-for="tag in tags" :key="tag.id">
                <tag-item :tag="tag"></tag-item>
            </div>
        </div>
    </div>
</template>

<script>
import tagItem from "./tag-Item";
import tagForm from "./tagForm";
import cardHeader from "../components/Cards/CardHeader.vue";
import { createdMixin } from "../mixins/createdMixin";

export default {
    components: { tagItem, tagForm, cardHeader },
        mixins: [createdMixin],
    data() {
        return {
            hover: false,
            isOpen: false,
            tags: []
        };
    },
    created() {
        this.getTags();
    },
    methods: {
        getTags() {
            axios
                .get(
                    "/api/organizations/" +
                        this.user.active_organization +
                        "/tags"
                )
                .then(response => {
                    this.tags = response.data.data;
                });
        }
    }
};
</script>
