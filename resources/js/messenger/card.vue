<template>
    <div class="border">
        <header class="flex justify-between items-center px-2 hover:bg-gray-200 py-2" @click="showCard =! showCard">
        <h3 class="font-semibold text-gray-700 cursor-pointer">Oznámenia od zamestnávateľa</h3>

        <svg v-if="showCard" class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 20 20">
            <path d="M7 10V2h6v8h5l-8 8-8-8h5z"/>
        </svg>

        <svg v-else class="h-3 w-3 text-gray-700" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 20 20">
            <path d="M7 10v8h6v-8h5l-8-8-8 8h5z"/>
        </svg>
        </header>

        <div v-show="showCard">
            <labels/>

            <form @submit.prevent="saveMessage">
            <vue-editor v-model="content" class="my-8"/>
                <button type="submit" class="btn btn-primary w-full mb-4">Poslať</button>
            </form>
        </div>
    </div>
</template>

<script>
    import labels from '../tag/tag-list';
    import {VueEditor} from "vue2-editor/dist/vue2-editor.core.js";

    export default {
        components: {labels, VueEditor},
        data() {
            return {
                content: "",
                showCard: true
            }
        },
        methods: {
            saveMessage(){
                if(this.content.length < 2){
                    alert('Správa je prázdna')
                }
            }
        }

    }
</script>
<style>
    @import "~vue2-editor/dist/vue2-editor.css";

    /* Import the Quill styles you want */
    @import '~quill/dist/quill.core.css';
    @import '~quill/dist/quill.bubble.css';
    @import '~quill/dist/quill.snow.css';
</style>
