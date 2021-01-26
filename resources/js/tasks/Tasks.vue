<template>
    <section>
        <h1 class="font-semibold">
            Úlohy
        </h1>
        <ul>
            <Task v-for="task in tasks" :key="task.id" :task="task"></Task>

<!--            <li v-for="task in tasks" :key="task.id" @click="updateTask()" class="flex justify-between cursor-pointer hover:bg-gray-100 p-2">-->
<!--                <span>{{ task.name }}</span>-->
<!--                <button class="bg-green-300 px-1 rounded-md">Done</button>-->
<!--            </li>-->
        </ul>
    </section>

</template>

<script>
    import { mapState, mapActions } from 'vuex';
    import  Task from './Task'
    export default {
        components:{ Task },

        created() {
            this.$store.dispatch('tasks/getTasks', {root: true})
        },

        computed:{
            ...mapState('tasks', ['tasks'])
        }

    }
</script>
