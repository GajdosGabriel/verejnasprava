<template>
    <div class="border-2 rounded-md border-gray-300 my-5" v-show="item.vote_disabled == 1">
        <div class="flex justify-between mb-3 bg-gray-300 p-1">
            <h4 class="font-semibold text-gray-800">Prihlásnenie do rozpravy</h4>
            <span class="text-sm" v-text="interpellations.length"></span>
        </div>
        <ul>

            <li v-for="interpellation in item.interpellations" :key="interpellation.user_id"
                class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="interpellation.user.first_name + ' ' + interpellation.user.last_name"></span>
                <span @click="storeInterpellation" class="text-gray-800 text-sm cursor-pointer">x</span>
            </li>

            <li class="flex justify-between border-b-2 border-dotted px-2">
                <span v-text="titleButton" @click="storeInterpellation" class="text-sm cursor-pointer"></span>
            </li>

        </ul>
    </div>


</template>

<script>
    import {bus} from '../app';
    export default {
        props: ['item'],
        data: function () {
            return {
                interpellations: [],
                authUser: this.user,
            }
        },
        computed: {
          titleButton: function () {
              // if(this.interpellations.user_id == this.authUser.id ){
              //     return 'je';
              // }
              return 'Odhlásiť sa'
          }
        },
        methods: {
            storeInterpellation: function () {
                axios.get('/inter/' + this.item.id + '/' +this.item.slug + '/item/interpellation')
            .then(response => {
                    this.interpellations = response.data;
                bus.$emit('interpelationChange', false);
                });
            }
        }
    }
</script>
