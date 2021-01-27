<template>

    <section>
        <header class="flex justify-between items-center px-2 py-2  cursor-pointer" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']">
            <div class="flex items-center justify-center">
                <svg class="fill-current h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                </svg>
                <h3 class="font-semibold cursor-pointer">Požiadavky</h3>
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

        <ul>
            <Task v-for="task in tasks" :key="task.id" :task="task"></Task>

        </ul>
        <span class="text-xs text-gray-500 cursor-pointer hover:text-gray-800" @click="showNewTask = ! showNewTask">Nová Požiadavka</span>
        <new-task v-if="showNewTask"/>

    </section>

</template>

<script>
    import { mapState, mapActions } from 'vuex';
    import  Task from './Task';
    import NewTask from "./NewTask";
    export default {
        components:{ Task, NewTask },
        data(){
          return {
              showCard: true,
              showNewTask: false,
          }
        },

        created() {
            this.$store.dispatch('tasks/getTasks', {root: true})
        },

        computed:{
            ...mapState('tasks', ['tasks'])
        }

    }
</script>
