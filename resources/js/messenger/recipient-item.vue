<template>
    <div class="ml-2 bg-green-300 rounded-md px-2 mb-2 cursor-pointer flex"
         :title="recipient.email">
        {{ recipient.first_name }} {{ recipient.last_name }}
        <span class="ml-1 text-gray-700 hover:text-gray-900" @click="deleteRecipient(recipient)" >x</span>
    </div>
</template>

<script>
    export default {
        props:['recipient'],
        methods: {
            deleteRecipient(recipient){
                this.$emit('deleteRecipient', recipient)
            }
        }
    }
</script>
