const state = {
    tasks: []

};
const getters = {

};

const mutations = {
    SET_TASKS(state, payload){
        state.tasks = payload
    }

};

const actions = {
    getTasks({commit}){
        axios.get('users/1/tasks')
            .then(response => {
                commit('SET_TASKS', response.data )
            })
    },

    updateTask({commit}, task){
        axios.put('users/1/tasks/' + task.id, task)
            .then(response => {
                // commit('SET_TASKS', response.data )
            })
    },

    storeTask({commit}, task){
        // console.log(task);
        axios.post('users/1/tasks', task)
            .then(response => {
                // commit('SET_TASKS', response.data )
            })
    }

};


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
