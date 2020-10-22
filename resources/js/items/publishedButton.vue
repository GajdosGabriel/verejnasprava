<template>
    <div @click="update(item)"
         v-if="$auth.isAdmin()"
         class="p-1 text-center whitespace-no-wrap flex-1 bg-gray-300 cursor-pointer1 whitespace-no-wrap cursor-pointer">

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
            update: function(item){
                if (item.votes.length){
                    alert('O bode sa hlasovalo. Publikovanie sa nemôže zrušiť!');
                    return
                }
                this.$store.dispatch('items/update', {id: item.id, published: ! item.published})
            }
        }


    }
</script>
