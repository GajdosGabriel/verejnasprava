<template>
    <div class="border-gray-400 border-b-2">

        <li class="flex justify-between cursor-pointer p-2"
            :class="[task.completed ? 'bg-green-200 hover:bg-green-300' : 'hover:bg-gray-200', dialog ? 'bg-green-300' : '']"
            @click="dialog = ! dialog"
        >
            <div class="flex justify-between text-xs w-full">
                <div>{{ task.name }}</div>
                <div class="text-xs">{{ task.user.first_name }} {{ task.user.last_name }}</div>
            </div>

            <svg class="fill-current h-5 w-5 mr-2" v-if="task.completed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </li>

        <div v-if="dialog" class="p-2">

            <div class=" w-full relative mb-8">
                <span v-if="! task.completed" @click="updateTask" class="text-xs bg-green-300 px-1 cursor-pointer rounded-sm absolute right-0">Vybavené</span>
                <span v-else @click="updateTask" class="text-xs bg-green-100 px-1 cursor-pointer rounded-sm absolute right-0">Obnoviť</span>
            </div>

            <div v-if="task.body" class="text-sm">
                {{ task.body}}
            </div>

            <!-- Comments section -->
            <section>
                <new-comment v-if="! task.completed" :task="task"/>
                <div  v-else class="flex justify-between text-xs text-gray-600">
                    <span>Úloha a diskusia bola ukončená dňa: {{ task.completed }}</span>
<!--                    <span>{{ task.completed }}</span>-->
                </div>
                <comment v-for="comment in task.comments" :comment="comment" :task="task" :key="comment.id" />
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
                dialog: this.task.dialog
            }
        },
        methods: {
            updateTask() {
                this.$store.dispatch('tasks/updateTask', {
                    id: this.task.id,
                    completed: this.task.completed ? null : new Date().toISOString().slice(0, 19).replace('T', ' ')
                }, {root: true});

                this.dialog = false;
            }
        }

    }
</script>
