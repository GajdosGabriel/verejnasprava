<template>
    <div class="text-xs flex mt-4">
        <span class="mr-4">{{ comment.user.first_name }} {{ comment.user.last_name }}:</span>
        <div class="bg-gray-200 w-full p-2 rounded-md">
            {{ comment.body }}
        </div>
    </div>
</template>
<script>
    export default {
        props: ['comment']

    }
</script>
