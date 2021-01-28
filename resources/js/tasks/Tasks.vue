<template>

    <section class="border">
        <header class="flex justify-between items-center px-2 py-2  cursor-pointer" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']">
            <div class="flex items-center justify-center">
                <svg class="fill-current h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd"
                          d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                          clip-rule="evenodd"/>
                </svg>
                <h3 class="font-semibold cursor-pointer">Požiadavky</h3>
            </div>

            <svg v-if="showCard" class="h-4 w-4 text-gray-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
            </svg>

            <svg v-else class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>


        </header>
        <div v-if="showCard">
            <ul>
                <Task v-for="task in completedTasks" :key="task.id" :task="task"></Task>
            </ul>

            <div class="flex justify-between text-xs text-gray-500 px-2">
                <span class="cursor-pointer hover:text-gray-800" @click="showNewTask = ! showNewTask">Nová Požiadavka</span>
                <span class=" cursor-pointer hover:text-gray-800">vybavené</span>
            </div>

            <new-task v-if="showNewTask" :users="users"/>

        </div>
    </section>

</template>

<script>
    import {mapState, mapActions, mapGetters} from 'vuex';
    import Task from './Task';
    import NewTask from "./NewTask";

    export default {
        components: {Task, NewTask},
        data() {
            return {
                showCard: true,
                showNewTask: false,
            }
        },

        created() {
            this.$store.dispatch('tasks/getTasks', {root: true});
            this.$store.dispatch('users/getUsers', {root: true});
        },

        computed: {
            ...mapState('tasks', ['tasks']),
            ...mapState('users', ['users']),
            ...mapGetters('tasks', [ 'completedTasks', 'uncompletedTasks'])
        }

    }
</script>
