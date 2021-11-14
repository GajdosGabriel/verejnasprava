const state = {
    tasks: [],
    setTaskList: false

};
const getters = {
    addDialogAttribute(state){
       return state.tasks.map(task => ({ ...task, dialog: false}))
    },

    taskList(state, getters){
        if (state.setTaskList){
            return getters.addDialogAttribute.filter(task => task.completed !==  null )
        }
        return getters.addDialogAttribute.filter(task => task.completed ==  null )
    }

};

const mutations = {
    SET_TASKS(state, payload){
        state.tasks = payload
    },

    SET_TASK_LIST(state, payload){
        state.setTaskList = payload

    }

};

const actions = {
    getTasks({commit}){
        axios.get('/api/users/1/tasks')
            .then(response => {
                commit('SET_TASKS', response.data )
            })
    },

    updateTask({commit, dispatch}, task){
        axios.put('/api/users/1/tasks/' + task.id, task)
            .then(response => {
                dispatch('getTasks')
                // commit('SET_TASKS', response.data )
            })
    },

    storeTask({commit, dispatch}, task){
        axios.post('/api/users/1/tasks', task)
            .then(response => {
                dispatch('getTasks')
            })
    },

    variantTaskList({commit}, payload){
        commit('SET_TASK_LIST', payload);
    }


};


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
