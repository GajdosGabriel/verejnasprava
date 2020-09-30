<template>

    <div class="border-2 rounded-md border-gray-300 my-5 max-w-sm"
         v-if="openList"
    >

        <div class="flex justify-between mb-3 bg-gray-300 p-1">
            <h4 class="font-semibold text-gray-800">Prihlásený do rozpravy <small class="text-sm">

                ({{ item.interpellations.length }})
            </small></h4>
            <span @click="storeInterpellation" class="text-sm cursor-pointer">
                Prihlásiť sa
            </span>
        </div>

        <ul>
            <li v-for="interpellation in item.interpellations" :key="interpellation.user_id"
                class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="interpellation.user.first_name + ' ' + interpellation.user.last_name"></span>
                <span @click="deleteItem(interpellation.id)" class="text-gray-800 text-sm cursor-pointer">x</span>
            </li>
        </ul>

    </div>

</template>

<script>
    import {bus} from '../app';
    import {mapState} from 'vuex';

    export default {
        props: ['item'],
        data: function(){
          return {
              openList: false
          }
        },
        computed: {
            ...mapState({
                // item: state => state.items.item,
                // openList: state => state.interpellations.openList
            })
        },
        created(){
            bus.$on('imterpellationlist', (data) => {
                if(data.id === this.item.id){
                    this.listToggle()
                }
            })
        },
        methods: {
            listToggle: function(){
              this.openList = ! this.openList
            },
            storeInterpellation: function () {
                this.$store.dispatch('interpellations/store', this.item);
            },

            deleteItem: function (id) {
                console.log(id);
                this.$store.dispatch('interpellations/delete', {id: id, meeting: this.item.meeting_id});
            }
        }
    }
</script>
