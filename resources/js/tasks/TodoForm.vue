<template>

    <div class="w-full flex justify-between">
        <input type="text p-1" v-model="newTodoItem" class="p-2 border-gray-400 border-2 rounded-l-lg focus-within:border-teal-500">
        <button @click="addNewTodoItem" class="btn btn-primary rounded-l-sm">Uložiť</button>
<!--        <button @click="addNewTodoItem" class="btn btn-primary">Uložiť</button>-->
    </div>

</template>

<script>

    export default {
        data: function () {
            return {
                newTodoItem: ''
            }

        },
        methods: {
            addNewTodoItem: function() {
                this.$store.commit('todos/NEWTODO', this.newTodoItem);
                // this.$store.dispatch('todos/addNewTodo', this.newTodoItem);
                this.newTodoItem = '';
            }
        }


    }
</script>
