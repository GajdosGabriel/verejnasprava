<template>
    <div class="text-xs flex mt-4">
        <div>
        <span class="mr-4 whitespace-no-wrap">{{ comment.user.first_name }} {{ comment.user.last_name }}:</span>
        <span class="mr-4 whitespace-no-wrap text-gray-500">{{ comment.created_at | fullDateTime }}</span>
        </div>

        <div class="bg-gray-200 w-full p-2 rounded-md flex justify-between  relative">
            <div v-if="! editFormComment">{{ comment.body }}</div>

            <input v-else @keyup.enter="updateComment" v-model="comment.body" class="w-full p-1 text-xs">

            <div v-if="comment.user.id == user.id" @click="showDropDown =! showDropDown" class="h5 w-5 cursor-pointer bg-white rounded-full flex justify-center items-center">
                <svg class="fill-current text-gray-400 hover:text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                <div v-if="showDropDown" class="bg-gray-100 flex flex-col items-center border-2 rounded-md border-gray-400">
                    <span v-if="! editFormComment" @click="editComment" class="px-3 py-2 hover:bg-gray-300 cursor-pointer">upraviť</span>
                    <span v-else @click="editFormComment = false" class="px-3 py-2 hover:bg-gray-300 cursor-pointer">zrušiť</span>
                    <span @click="deleteComment" class="px-3 py-2 hover:bg-gray-300 cursor-pointer">zmazať</span>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import {bus} from "../../app";
    import moment from 'moment';
    import {filterMixin} from "../../mixins/filterMixin";

    export default {
        props: ['comment', 'task'],
        mixins:[filterMixin],
        data() {
            return {
                showDropDown: false,
                editFormComment: false
            }
        },
        created: function () {
            let self = this;
            window.addEventListener('click', function (e) {
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)) {
                    self.showDropDown = false;
                    self.showDropDown = false;
                }
            });
        },

        methods: {
            deleteComment() {
                axios.delete('tasks/' + this.task.id + '/comments/' + this.comment.id)
                    .then(response => {
                        this.showDropDown = false;
                        this.$store.dispatch('tasks/getTasks', {root: true});
                    })
            },
            editComment() {
                this.editFormComment = true
            },

            updateComment() {
                axios.put('tasks/' + this.task.id + '/comments/' +  this.comment.id, {
                    body: this.comment.body,
                })
                    .then(response => {
                        this.body = null;
                        this.$store.dispatch('tasks/getTasks', {root: true});
                    });

                this.editFormComment = false;
            }
        }

    }
</script>
