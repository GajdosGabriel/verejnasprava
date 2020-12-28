<template>
    <div class="border">
        <header class="flex justify-between items-center px-2 py-2  cursor-pointer" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']">
            <div class="flex items-center justify-center">
                <svg class="fill-current h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                <h3 class="font-semibold cursor-pointer" v-text="title">Oznámenia od zamestnávateľa</h3>
            </div>


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
            <div class="my-4 p-2 border flex flex-wrap relative">Komu: <span v-if="recipients && recipients.length > 0"> ({{ recipients.length }})</span>
                <div v-for="recipient in recipients" :key="recipient.id">
                    <recipientItem :recipient="recipient" @deleteRecipient="removeRecipient"/>
                </div>

                <span v-if="recipients && recipients.length > 1" class="absolute bottom-0 right-0 text-xs cursor-pointer" @click="clearRecipientsList">vyčistiť všetko</span>
            </div>

            <div class="flex justify-between text-xs">
                <span class="px-2 cursor-pointer" @click="getAllUsers">všetkým</span>
                <span class="px-2 cursor-pointer" @click="showTag =! showTag">nálepky</span>
                <span class="px-2 cursor-pointer" @click="showUsers =! showUsers">zamestnanci</span>
            </div>

            <div v-if="showTag">
                <div class="flex justify-between text-xs">
                    <span class="px-2 cursor-pointer" @click="showModal = true">Nová nálepka</span>
                    <span class="px-2 cursor-pointer" @click="editAdminPanel = ! editAdminPanel">Upraviť</span>
                </div>
                <tag-list :tags="tags" :editAdminPanel="editAdminPanel" @pushTagToRecipientList="getUsersByTag" @editTag="getEditTag"/>
            </div>

            <user-list :showUsers="showUsers"/>

            <form @submit.prevent="saveMessage" enctype="multipart/form-data">
                <input type="text" class="w-full p-1 mt-4 mb-2 border" placeholder="Nadpis správy" v-model="name">
                <vue-editor v-model="body" class="mb-8"/>

                <div class="form-group">

                    <div class="">
                        <label for="filename" class="font-semibold">Prílohy k návrhu</label>
                        <input type="file" id="filename" multiple @change="onFileChange"/>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-full">
                    <div class="flex items-center justify-center">
                        <svg class="fill-current h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span>Poslať</span>
                    </div>

                </button>
            </form>
        </div>

        <tag-modal :showModal="showModal" :passEditTag="editTag" @addNewTag="addNewTag" @emitShowModal="showModal = false"/>
    </div>
</template>

<script>
    import recipientItem from './recipient-item';
    import tagList from './tag-list';
    import tagModal from './new-modal';
    import userList from './users-list';
    import {VueEditor} from "vue2-editor/dist/vue2-editor.core.js";

    export default {
        components: {tagList, VueEditor, tagModal, recipientItem, userList},
        data() {
            return {
                title: "Oznámenia od zamestnávateľa",
                name: "Správa od zamestnávateľa",
                body: "",
                postFormData: new FormData(),
                recipients: [],
                showCard: false,
                showModal: false,
                showTag: false,
                showUsers: false,
                editAdminPanel: false,
                editTag: {},
                tags: []
            }
        },
        created() {
            this.getTags();
        },
        methods: {
            onFileChange(event) {
                for (var key in event.target.files) {
                    this.postFormData.append('filename[]', event.target.files[key]);
                }
            },

            getAllUsers() {
                axios.get('/users')
                    .then((response) => {
                        this.recipients.push(...response.data);
                    })
            },
            getUsersByTag(tag) {
                axios.get('/tags/' + tag.id + '/users')
                    .then((response) => {
                        this.recipients.push(...response.data);

                        // Romve double adresse
                        this.recipients = Object.values(this.recipients.reduce((acc, cur) => Object.assign(acc, {[cur.id]: cur}), {}))
                    })
            },
            clearRecipientsList() {
                this.recipients = [];
                this.getTags()
            },
            addRecipient(form) {
                this.recipients.push(form);
                this.tags.splice(this.tags.indexOf(form), 1);
            },
            removeRecipient(recipient) {
                this.recipients.splice(this.recipients.indexOf(recipient), 1);
            },
            addNewTag(form) {
                this.tags.push(form);
            },
            getEditTag(tag) {
                this.editTag = tag;
                this.showModal = !this.showModal
            },
            getTags() {
                axios.get('/tags')
                    .then((response) => {
                        this.tags = response.data
                    })
            },

            saveMessage() {
                if (this.body.length < 2) {
                    return alert('Správa je prázdna.')
                }

                if (this.recipients.length == 0) {
                    return alert('Nezadali ste prijímatteľa.')
                }

                //  // Form add file
                // const formData = new FormData();
                //  this.postFormData.append('body', this.body);
                //  this.postFormData.append('name', this.name);
                //  this.postFormData.append('recipients[]', this.recipients);

                // axios.post('/messengers', this.postFormData)
                axios.post('/messengers', {body: this.body, name: this.name, recipients: this.recipients})
                    .then(
                        this.body = null,
                        this.name = null,
                        this.recipients = null,
                        this.showCard = false,
                        this.title = 'Správa bola rozoslaná'
                    );
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
