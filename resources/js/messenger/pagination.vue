<template>
    <div  v-if="showPaginator" class="flex justify-center space-x-3 text-xs my-4">
        <button @click="fetchPaginate(data.prev_page_url)"
                class="flex items-center justify-center h-4 p-2 font-semibold hover:bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
                :disabled="! data.prev_page_url"> <<
        </button>
        <div
            class="flex items-center justify-center h-4 p-2 font-semibold border-2 border-gray-600 rounded-sm">
            {{ data.current_page}} / {{ data.last_page}}
        </div>
        <button @click="fetchPaginate(data.next_page_url)"
                class="flex items-center justify-center h-4 p-2 font-semibold hover:bg-gray-400 border-2 border-gray-600 rounded-sm cursor-pointer"
                :disabled="! data.next_page_url"> >>
        </button>
    </div>

</template>
<script>

    import {mapState} from "vuex";

    export default {
        props: ['data'],

        computed:{
            showPaginator(){
                if (this.data.data.length){
                    return false
                }

                if (this.data.data.length > this.data.per_page){
                    return true
                }
            }
        },

        methods: {
            fetchPaginate: function (url) {
                this.$emit('urlMessengers', url)
            }
        }

    }
</script>
