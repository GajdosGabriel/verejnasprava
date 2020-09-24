<template>
    <div @click="publishedToggle(item)">

        <span v-if="item.published"  class="badge badge-primary">Publikované</span>

        <span  v-else class="badge badge-secondary">Publikovať</span>

    </div>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        computed:{
            ...mapState({
                item: state => state.items.item,
            }),
        },
        methods: {
            publishedToggle: function(item){
                this.$store.dispatch('items/publishedToggle', item)
            }
        }


    }
</script>
