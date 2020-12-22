<template>
    <div class="ml-2 bg-green-300 rounded-md px-2 mb-2 cursor-pointer flex"
         @click="deleteRecipient(recipient)" title="Kliknutím odstrániť">
        {{ recipient.name }}
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
