<template>
    <div class="w-1/5">
        <div class="flex justify-between mb-1 border-b border-gray-600">
            <h3>Dokončené: {{ $store.getters['todos/completedTodos'] }}</h3>
            <h3>Nedokončené: {{ $store.getters['todos/pendingTodos'] }}</h3>
        </div>

        <todo v-for="(todo, index) in todos" :key="index" :todo="todo" class="hover:bg-gray-300 p-2 flex items-center rounded-sm"></todo>
        <todo-form class="my-4"></todo-form>
    </div>

</template>
<script>
    import todo from '../tasks/Todo';
    import todoForm from '../tasks/TodoForm';

    export default {
        components: {todo, todoForm},
        computed: {
            todos: function () {
                return this.$store.state.todos.todos;
            }
        }
    }
</script>
