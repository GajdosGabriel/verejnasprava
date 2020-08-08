import Vue from 'vue'
import Vuex from 'vuex'
// import currentUser from "./modules/currentUser";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
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

    },
    getters: {
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

    },
    mutations: {
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
        toggle_todo_status: function(state, todoItem) {
            todoItem.completed = ! todoItem.completed;
        }

    },
    // dispatch
    actions: {
        addNewTodo: function ({commit}, todoData) {
            commit('NEWTODO', todoData)
        },

        deleteTodo: function ({commit}, todoData) {
            commit('DELETETODO', todoData);
        },
        toggleTodoStatus: function ({commit}, todoItem ) {
            commit('toggle_todo_status', todoItem);
        }

    }
});

// export default new Vuex.Store({
//     modules: {
//         currentUser
//     }
// })
