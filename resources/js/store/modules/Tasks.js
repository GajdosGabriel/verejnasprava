const state = {
    tasks: [],
    completedTaskList: [],
    uncompletedTaskList: [],
    setTaskList: false

};
const getters = {
    tasksList(state){
        if(state.activeTaskList) {
            return state.completedTaskList;
        }
        return state.uncompletedTaskList;
    },

};

const mutations = {
    SET_TASKS(state, payload){
        state.completedTaskList = payload.filter(task => task.completed !== null );
        state.uncompletedTaskList = payload.filter(task => task.completed ==  null )
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
