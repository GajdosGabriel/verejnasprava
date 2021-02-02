<template>
    <div class="border-gray-400 border-b-2" :class="{'border-green-500 border-2' : dialog}">

        <li class="flex justify-between cursor-pointer p-2"
            :class="[task.completed ? 'bg-green-200 hover:bg-green-300' : 'hover:bg-gray-200', dialog ? 'bg-green-300' : '']"
            @click="dialog = ! dialog"
        >
            <div class="flex justify-between items-center text-xs w-full">
                <div>
                    <div v-if="!showEditForm" class="font-semibold">{{ task.name }}</div>
                    <div v-if="task.due_date" class="text-xs whitespace-no-wrap">{{ task.due_date }} {{ task.due_time }}</div>
                </div>

                <input v-if="showEditForm" @keyup.enter="updateTask" type="text" v-model="task.name" class="w-full h-8 px-2 mr-2 rounded">


                <div class="text-xs whitespace-no-wrap">{{ task.user.first_name }} {{ task.user.last_name }}</div>


            </div>

            <svg class="fill-current h-5 w-5 mr-2" v-if="task.completed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </li>

        <div v-if="dialog" class="p-2">

            <div class="w-full mb-8 flex justify-between">
                <span v-if="userOwner && ! showEditForm" @click="editTask" class="text-xs bg-green-100 px-1 cursor-pointer rounded-sm">Upraviť</span>
                <span v-else @click="showEditForm = false" class="text-xs bg-green-100 px-1 cursor-pointer rounded-sm">Zrušiť úpravy</span>

                <span v-if="! task.completed" @click="updateCompleted" class="text-xs bg-green-300 px-1 cursor-pointer rounded-sm ">Vybavené</span>
                <span v-else @click="updateCompleted" class="text-xs bg-green-100 px-1 cursor-pointer rounded-sm">Obnoviť</span>
            </div>

            <div v-if="!showEditForm" class="text-sm">{{ task.body}}</div>

            <textarea @keyup.enter="updateTask" v-else v-model="task.body" class="border w-full text-sm p-2 border-gray-400 rounded">{{ task.body}}</textarea>

            <!--            <div v-if="showEditForm" @click="updateTask" class="my-3 py-2 text-white text-center bg-blue-500 hover:bg-blue-700 px-1 w-full cursor-pointer rounded-sm">Uložiť zmeny</div>-->

            <div v-if="showEditForm" class="flex w-full mb-4 text-xs">
                <div class="mr-5">
                    <label for="start" class="mr-3">Do:</label>
                    <input type="date" id="start" name="trip-start"
                           v-model="task.due_date"
                           min="formData.date" max="" @keyup.enter="updateTask">
                </div>

                <div>
                    <label for="time" class="mr-3">Čas:</label>
                    <input type="time" id="time" name="appt"
                           v-model="task.due_time" @keyup.enter="updateTask"
                    >
                </div>
            </div>

            <!-- Comments section -->
            <section v-if="commentsSection">
                <new-comment v-if="! task.completed" :task="task"/>
                <div v-else class="flex justify-between text-xs text-gray-600">
                    <span>Úloha a diskusia bola ukončená dňa: {{ task.completed }}</span>
                    <!--                    <span>{{ task.completed }}</span>-->
                </div>
                <comment v-for="comment in task.comments" :comment="comment" :task="task" :key="comment.id"/>
            </section>
        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex';
    import NewComment from "./Comments/NewComment";
    import Comment from "./Comments/Comment";

    export default {
        props: ['task'],
        components: {NewComment, Comment},
        data() {
            return {
                dialog: this.task.dialog,
                showEditForm: false,
                commentsSection: true
            }
        },
        computed: {
            userOwner() {
                if (this.task.user_id == this.user.id) {
                    return true
                }
            }

        },
        methods: {
            updateCompleted() {
                this.$store.dispatch('tasks/updateTask', {
                    id: this.task.id,
                    completed: this.task.completed ? null : new Date().toISOString().slice(0, 19).replace('T', ' ')
                }, {root: true});

                this.dialog = false;
            },
            editTask() {
                this.showEditForm = true;
                this.commentsSection = false;
            },
            updateTask() {
                this.$store.dispatch('tasks/updateTask', this.task, {root: true});
                this.showEditForm = false;
            }
        }

    }
</script>
