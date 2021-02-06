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


            <svg v-if="markAsCompleted.length" @click="multiUpdateCompleted" class="hover:text-gray-300 rounded-md w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                      clip-rule="evenodd"/>
            </svg>


            <card-header-icon :showCard="showCard"/>

        </header>
        <div v-show="showCard">
            <ul>
                <Task v-for="task in sortedList" :key="task.id" :task="task" @pushMarkAsCompleted="addOrRemoveTaskCompleted"></Task>
            </ul>

            <div class="flex justify-between text-xs text-gray-500 px-2">
                <span class="cursor-pointer hover:text-gray-800" @click="showNewTask = ! showNewTask" v-text="newTaskTitle">Nová Požiadavka</span>
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
    import {bus} from "../app";

    export default {
        components: {Task, NewTask, CardHeaderIcon},
        data() {
            return {
                showCard: true,
                showNewTask: false,
                markAsCompleted: []
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
            ...mapGetters('tasks', ['taskList']),

            newTaskTitle() {
                return this.showNewTask ? 'Zavrieť' : 'Nová Požiadavka'
            },

            sortedList() {
                return _.orderBy(this.taskList, 'due_date');
            },

            nameOfList() {
                return this.setTaskList ? 'aktívne' : 'vybavené'
            },

        },
        methods: {
            ...mapActions('tasks', ['variantTaskList']),

            multiUpdateCompleted() {
                axios.put('/tasks/1', this.markAsCompleted)
                    .then(response => {
                        this.$store.dispatch('tasks/getTasks', {root: true});
                    });

                this.markAsCompleted = [];
            },

            addOrRemoveTaskCompleted(task) {
                if (this.markAsCompleted.find(t => (t.id == task.id))) {
                    return this.markAsCompleted = this.markAsCompleted.filter(m => {
                        return m.id !== task.id;
                    });
                }
                this.markAsCompleted.push(task);
            },

            changeTaskList() {
                this.variantTaskList(!this.setTaskList)
            }
        }

    }
</script>
