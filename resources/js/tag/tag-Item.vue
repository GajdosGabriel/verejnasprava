<template>
    <div class="flex items-center  mr-2">
        <div v-text="tag.name"
             class=" px-2 rounded-md m-1 cursor-pointer bg-green-200 hover:bg-green-400">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['tag'],
        data() {
            return {

            }
        }

    }
</script>
