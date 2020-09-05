const state = {
    todos: [
        {
            title: '1 To do item',
            completed: false
        },

        {
            title: '2 To do item',
            completed: false
        }
    ]
};
const getters = {
    completedTodos: function (state) {
        return state.todos.filter( todo => {
            return todo.completed == true
        }).length
    },

    pendingTodos: function (state) {
        return state.todos.filter( todo => {
            return todo.completed == false
        }).length
    }
};
const actions = {
    addNewTodo: function ({commit, dispatch}, todoData) {
        commit('NEWTODO', todoData);

        // Notify for add task
        dispatch('notification/addNewNotification', {
            type: 'bg-green-400',
            message: 'Add new task'
        }, {root: true})
    },

    deleteTodo: function ({commit, dispatch}, todoData) {
        commit('DELETETODO', todoData);

        // Notify for deleteing task
        dispatch('notification/addNewNotification', {
            type: 'bg-red-400',
            message: 'Task has been deleted.'
        }, {root: true})
    },
    toggleTodoStatus: function ({commit}, todoItem ) {
        commit('TOOGLE_TODO_STATUS', todoItem);
    }
};
const mutations = {
    NEWTODO: function(state, todoData ) {
        state.todos.push({
            title: todoData,
            completed: false
        });
    },
    DELETETODO: function (state, todoData) {
        let index = state.todos.indexOf(todoData);
        state.todos.splice(index, 1);
    },
    TOOGLE_TODO_STATUS: function(state, todoItem) {
        todoItem.completed = ! todoItem.completed;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
