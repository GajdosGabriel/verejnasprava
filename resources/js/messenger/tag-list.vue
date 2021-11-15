<template>
    <div class="flex flex-wrap">
        <div v-for="tag in tags" :key="tag.id">
            <div class="flex items-center mr-2">
                <div v-text="tag.name"
                     @click="addToList(tag)"
                     class=" px-2 rounded-md m-1 cursor-pointer bg-green-200 hover:bg-green-300" title="Kliknutím pridať">
                </div>
                <div v-if="editAdminPanel" class="cursor-pointer hover:bg-gray-200 text-xs" @click="editTag(tag)">Upraviť</div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        props:['tags','editAdminPanel'],
        methods:{
            addToList(tag){
                this.$emit('pushTagToRecipientList', tag)
            },
            editTag(tag){
                this.$emit('editTag', tag);
            },

            // getTags(){
            //     axios.get('/api/organizations/' + this.user.active_organization + '/tags')
            //     .then( response => {
            //         this.tags = response.data
            //     })
            // }
        }
    }
</script>
