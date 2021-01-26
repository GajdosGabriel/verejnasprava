<template>
    <li @click="updateTask" class="flex justify-between cursor-pointer hover:bg-gray-100 p-2">
        <span>{{ task.name }}</span>
        <button class="bg-green-300 px-1 rounded-md">Done</button>
    </li>
</template>
<script>

    export default {
        props:['task'],
        methods:{
            updateTask(){
                this.$store.dispatch('tasks/updateTask', {id: this.task.id, completed: this.task.completed = ! this.task.completed}, {root:true})
            }
        }

    }
</script>
