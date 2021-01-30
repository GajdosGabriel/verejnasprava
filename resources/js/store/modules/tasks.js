const state = {
    tasks: [],
    setTaskList: false

};
const getters = {
    taskList(state){
        if (state.setTaskList){
            return state.tasks.filter(task => task.completed !==  null )
        }
        return state.tasks.filter(task => task.completed ==  null )
    }

};

const mutations = {
    SET_TASKS(state, payload){
        state.tasks = payload.map(task => ({ ...task, dialog: false}))
    },

    SET_TASK_LIST(state, payload){
        state.setTaskList = payload
    }

};

const actions = {
    getTasks({commit}){
        axios.get('users/1/tasks')
            .then(response => {
                commit('SET_TASKS', response.data )
            })
    },

    updateTask({commit, dispatch}, task){
        axios.put('users/1/tasks/' + task.id, task)
            .then(response => {
                dispatch('getTasks')
                // commit('SET_TASKS', response.data )
            })
    },

    storeTask({commit, dispatch}, task){
        axios.post('users/1/tasks', task)
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
