<template>
    <div @click="publishedToggle(item)"
         class="text-sm text-center whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer1 whitespace-no-wrap cursor-pointer">

        <span v-if="item.published">Publikované</span>

        <span  v-else >Publikovať</span>

    </div>
</template>

<script>
    import {mapState} from 'vuex';
    export default {
        props:['item'],
        computed:{
            ...mapState({
                // item: state => state.items.item,
            }),
        },
        methods: {
            publishedToggle: function(item){
                this.$store.dispatch('items/publishedToggle', item)
            }
        }


    }
</script>
