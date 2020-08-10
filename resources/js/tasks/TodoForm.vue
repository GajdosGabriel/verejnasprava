<template>

    <div class="w-full flex justify-between">
        <input type="text p-1" v-model="newTodoItem" class="p-2">
        <button @click="addNewTodoItem" class="btn btn-primary">Uložiť</button>
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
                this.$store.dispatch('todos/addNewTodo', this.newTodoItem);
                this.newTodoItem = '';
            }
        }


    }
</script>
