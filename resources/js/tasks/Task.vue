<template>
    <div>

        <li class="flex justify-between cursor-pointer  p-2"
            :class="[task.completed ? 'bg-green-200 hover:bg-green-300' :'hover:bg-gray-200']"
            @click="dialog = ! dialog"
        >
            <div class="flex flex-col">
                <span class="text-xs">{{ task.user.first_name }} {{ task.user.last_name }}</span>
                <span>{{ task.name }}</span>
            </div>

            <svg class="fill-current h-5 w-5 mr-2" v-if="task.completed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </li>

        <div v-if="dialog" class="p-2">
            <span v-if="! task.completed" @click="updateTask" class="text-xs bg-green-300 px-1 cursor-pointer rounded-md flex justify-end">Vybavené</span>
            <span v-else  @click="updateTask" class="text-xs bg-green-100 px-1 cursor-pointer rounded-md flex justify-end">Obnoviť</span>
            <div>
                komentáre
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        props: ['task'],
        data() {
            return {
                dialog: true
            }
        },
        methods: {
            updateTask() {
                this.$store.dispatch('tasks/updateTask', {id: this.task.id, completed: this.task.completed = !this.task.completed}, {root: true})
            }
        }

    }
</script>
