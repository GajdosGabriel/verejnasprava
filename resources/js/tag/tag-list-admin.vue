<template>
    <div class="flex flex-wrap">
        <div v-for="tag in tags" :key="tag.id">
            <tag-item-admin :tag="tag"></tag-item-admin>
        </div>
    </div>
</template>

<script>
    import tagItemAdmin from './tag-Item-admin'

    export default {
        components: {tagItemAdmin},
        data() {
            return {
                hover: false,
                tags:{}
            }
        },
        created() {
            this.getTags();
        },


        methods: {
            getTags() {
                axios.get('/tags')
                    .then((response) => {
                        this.tags = response.data
                    })
            },


        }

    }
</script>
