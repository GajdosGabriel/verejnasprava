<template>
    <div class="flex flex-wrap">

        <div v-for="tag in tags" :key="tag.id">
            <div class="flex items-center mr-2" @click="addToList(tag)">
                <div v-text="tag.name"
                     class=" px-2 rounded-md m-1 cursor-pointer bg-green-200 hover:bg-green-400">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['tags'],
        methods:{

        }
    }
</script>
