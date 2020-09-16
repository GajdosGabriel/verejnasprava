<template>
    <a href="">

        <span v-if="item.published" @click="postToggle" class="badge badge-primary">Publikované</span>

        <span  v-else class="badge badge-secondary">Publikovať</span>

    </a>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        props: ['post'],

        methods: {
            postToggle: function(){

            }
        }


    }
</script>