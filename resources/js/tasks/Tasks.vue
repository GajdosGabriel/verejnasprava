<template>

    <section class="border" v-if="active.find(id => id.id == 6)">
        <header class="flex justify-between items-center px-2 py-2  cursor-pointer" @click="showCard =! showCard"
                :class="[showCard ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']">
            <div class="flex items-center justify-center">
                <svg class="fill-current h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd"
                          d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                          clip-rule="evenodd"/>
                </svg>
                <h3 class="font-semibold cursor-pointer">Úlohy ({{ taskList.length }})</h3>
            </div>

            <card-header-icon :showCard="showCard"/>

        </header>
        <div v-if="showCard">
            <ul>
                <Task v-for="task in taskList" :key="task.id" :task="task"></Task>
            </ul>

            <div class="flex justify-between text-xs text-gray-500 px-2">
                <span class="cursor-pointer hover:text-gray-800" @click="showNewTask = ! showNewTask">Nová Požiadavka</span>
                <span class="cursor-pointer hover:text-gray-800" @click="changeTaskList" v-text="nameOfList">vybavené</span>
            </div>

            <new-task v-if="showNewTask" :users="users"/>

        </div>
    </section>

</template>

<script>
    import {mapState, mapActions, mapGetters} from 'vuex';
    import Task from './Task';
    import NewTask from "./NewTask";
    import CardHeaderIcon from "../components/Cards/CardHeaderIcon";

    export default {
        components: {Task, NewTask, CardHeaderIcon},
        data() {
            return {
                showCard: true,
                showNewTask: false
            }
        },

        created() {
            this.$store.dispatch('tasks/getTasks', {root: true});
            this.$store.dispatch('users/getUsers', {root: true});
        },

        computed: {
            ...mapState('tasks', ['setTaskList']),
            ...mapState('users', ['users']),
            ...mapState('organization', ['active']),
            ...mapGetters('tasks', ['getUncompletedTasks', 'getCompletedTasks']),

            nameOfList(){
                return this.setTaskList ?  'aktívne' : 'vybavené'
            },

            taskList(){
                if (this.setTaskList){
                    return this.getCompletedTasks
                }
                return this.getUncompletedTasks
            }
        },
        methods: {
            ...mapActions('tasks', ['variantTaskList']),

            changeTaskList(){
                this.variantTaskList(! this.setTaskList)
            }
        }

    }
</script>
