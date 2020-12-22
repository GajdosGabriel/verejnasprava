<template>
    <div @mouseover="deleteIcon = true"
         @mouseout="deleteIcon = false"
         class="ml-2 bg-green-300 rounded-md px-2 mb-2 cursor-pointer flex"
    >
        {{ recipient.name }}
        <span v-show="deleteIcon" class="ml-2" @click="deleteRecipient(recipient)">x</span>
    </div>
</template>

<script>
    export default {
        props:['recipient'],
        data(){
            return{
                deleteIcon: false,
            }
        },
        methods: {
            deleteRecipient(recipient){
                this.$emit('deleteRecipient', recipient)

            }
        }
    }
</script>
