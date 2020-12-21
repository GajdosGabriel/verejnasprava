<template>
    <div class="flex flex-wrap">
        <div v-for="tag in tags" :key="tag.id">
            <tag-item :tag="tag"></tag-item>
        </div>
    </div>
</template>

<script>
    import tagItem from './tag-Item'

    export default {
        props: ['tags'],
        components: {tagItem},
        data() {
            return {
                hover: false,

            }
        },

        methods: {


        }

    }
</script>
