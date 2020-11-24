<template>

    <div class=" border-2 rounded-md border-gray-300 w-full"
         v-if="openList && ! item.vote_status"
    >
        <div class="lg:flex lg:justify-between bg-gray-300 p-1 mb-4">
            <h4 class="font-semibold text-gray-800">Do rozpravy <small class="text-sm">

                ({{ item.interpellations.length }})
            </small></h4>
            <span @click="updateInterpellation" class="text-sm cursor-pointer">
                {{ hasUserInterpellation }}
            </span>
        </div>

        <ul>
            <li v-for="interpellation in item.interpellations" :key="interpellation.user_id"
                class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="interpellation.user.first_name + ' ' + interpellation.user.last_name"></span>
                <span v-if="$auth.can('council delete')" @click="deleteItem(interpellation.id)" class="text-gray-800 text-sm cursor-pointer">x</span>
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
        computed:{
            hasUserInterpellation: function () {
                var intUsers = this.item.interpellations.map(role => role.user.id);
               return  intUsers.includes( this.user.id) ? 'Odhlásiť sa' : 'Prihlásiť sa';
            }
        },
        created(){
            bus.$on('imterpellationlist', (data) => {
                if(data.id === this.item.id){
                    this.listToggle()
                }
            });
        },
        methods: {
            listToggle: function(){
                if(this.item.vote_status || this.item.votes.length > 0){
                  return alert('Počas hlasovania sú interpelácie vypnuté!')
                }
              this.openList = ! this.openList
            },

            updateInterpellation: function () {
                this.$store.dispatch('items/updateInterpellation', this.item );
            },

            deleteItem: function (id) {
                this.$store.dispatch('items/deleteInterpellation', id);
            }
        }
    }
</script>
