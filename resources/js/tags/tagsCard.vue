<template>
    <Card>
        <card-header
            :icon="'tag'"
            :title="'Nálepky'"
            :title2="null"
            :isOpen="isOpen"
            @click.native="isOpen = !isOpen"
        />

        <tag-form v-if="isOpen" @addNewTag="getTags" />
        <div v-if="isOpen">
            <div v-for="tag in tags" :key="tag.id">
                <tag-item :tag="tag"></tag-item>
            </div>
        </div>
    </Card>
</template>

<script>
import Card from "../components/Cards/Card.vue";
import tagItem from "./tag-Item";
import tagForm from "./tagForm";
import cardHeader from "../components/Cards/CardHeader.vue";
import { createdMixin } from "../mixins/createdMixin";

export default {
    components: { tagItem, tagForm, cardHeader, Card },
    mixins: [createdMixin],
    data() {
        return {
            hover: false,
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
