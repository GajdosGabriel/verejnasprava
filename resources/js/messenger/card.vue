<template>
    <div class="border">
        <header class="flex justify-between items-center px-2 py-2" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']"
        >
            <h3 class="font-semibold cursor-pointer">Oznámenia od zamestnávateľa</h3>

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
            <div class="my-4 p-2 border">Komu:
                <div v-for="recipient in recipients">{{ recipient.name }}</div>
            </div>

            <span class="px-2 cursor-pointer" @click="showModal = true">Nová nálepka</span>

            <tag-list :tags="tags"/>

            <form @submit.prevent="saveMessage">
                <input type="text" class="w-full px-1 mt-4 mb-2" placeholder="Správa od zamestnávateľa" v-model="name">
                <vue-editor v-model="body" class="mb-8"/>
                <button type="submit" class="btn btn-primary w-full">Poslať</button>
            </form>
        </div>

        <tag-modal :showModal="showModal" @addTag="addTag" @emitShowModal="showModal = false"/>
    </div>
</template>

<script>
    import tagList from './tag-list';
    import tagModal from './new-modal';
    import {VueEditor} from "vue2-editor/dist/vue2-editor.core.js";

    export default {
        components: {tagList, VueEditor, tagModal},
        data() {
            return {
                name: "",
                body: "",
                recipients: {},
                showCard: true,
                showModal: false,
                tags:{}
            }
        },
        created() {
            this.getTags();
        },
        methods: {
            addTag(form){
                this.tags.push(form);
            },
            getTags() {
                axios.get('/tags')
                    .then((response) => {
                        this.tags = response.data
                    })
            },

            saveMessage() {
                if (this.body.length < 2) {
                    alert('Správa je prázdna.')
                }

                axios.post('/messengers', {body: this.body, name: this.name})
                    .then(
                        this.body = null,
                        this.name = null
                    )
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
