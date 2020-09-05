<template>
    <div>
        <ul>
<!--            <li v-for="post in posts" v-text="post.name"></li>-->
        </ul>

    </div>

</template>

<script>
    export default {
        computed: {
            posts: function() {
                return this.$store.state;
            }
        }
    }
</script>
