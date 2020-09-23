<template>

    <div class="w-full flex justify-between my-2">
        <span :class="{completed: todo.completed}" class="cursor-pointer" @click="toggleTodoStatus">{{ todo.title }}</span>
    <button @click="$store.commit('todos/DELETETODO', todo)" class="btn text-xs">Zmazať</button>
    </div>

</template>

<script>

    export default {
        props:['todo'],

        methods: {
            deleteTodo: function () {
                this.$store.dispatch('todos/deleteTodo', this.todo);
            },
            toggleTodoStatus: function() {
                this.$store.dispatch('todos/toggleTodoStatus', this.todo);
            }
        }

    }
</script>
<style>
    .completed {
        text-decoration: line-through;
    }
</style>
