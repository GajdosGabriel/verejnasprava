const state = {
    user: {},
    users: []

};
const getters = {};

const mutations = {
    SET_USERS: function (state, payload) {
        state.users = payload
    },
    SET_USER: function (state, payload) {
        state.user = payload
    }

};
const actions = {
    getUsers({commit}) {
        axios.get('/api/organizations/1/users')
            .then(response => {
                    commit('SET_USERS', response.data);
                }
            );
    },

    getUser({commit}) {
        axios.get('/api/user')
            .then(response => {
                    commit('SET_USER', response.data);
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
