const state = {
    users: []

};
const getters = {};

const mutations = {
    SET_USERS: function (state, payload) {
        state.users = payload
    }

};
const actions = {
    getUsers({commit}) {
        axios.get('/api/organizations/1/users')
            .then(response => {
                    commit('SET_USERS', response.data);
                }
            );
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
