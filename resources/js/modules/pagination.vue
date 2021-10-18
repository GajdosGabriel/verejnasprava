<template>
    <div class="flex justify-center my-10 space-x-3" v-if="data.meta.last_page > 1" >
        {{ }}
        <button
            @click="$emit('pathUrl', data.prev_page_url)"
            class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
            :disabled="!data.prev_page_url"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
        <div
            class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm"
        >
            {{ data.meta.current_page }} / {{ data.meta.last_page }}
        </div>
        <button
            @click="$emit('pathUrl', data.links.next)"
            class="flex items-center justify-center h-8 p-3 font-semibold bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
            :disabled="!data.links.next"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 20 20"
                fill="currentColor"
            >
                <path
                    fill-rule="evenodd"
                    d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                />
                <path
                    fill-rule="evenodd"
                    d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
</template>
<script>
export default {
    props: ["data"]
};
</script>
