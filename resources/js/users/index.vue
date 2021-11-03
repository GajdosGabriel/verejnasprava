<template>
    <div>
        {{ user }}
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            baseUrl: window.App.baseUrl,
            currentUrlSegment: window.location.pathname
        };
    },
    computed: {
        ...mapState("users", ["user"])
    },
    methods: {},
    created: function() {
        this.$store.dispatch("users/getUser");
    }
};
</script>
