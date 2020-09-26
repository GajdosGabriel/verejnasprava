const state = {
    councils: []
};
const getters = {};

const mutations = {
    SET_COUNCILS: function(state, payload) {
        state.councils = payload
    }


};
const actions = {
    fetchConcils({commit}, payload) {
        axios.get('/api/councils/' + payload + '/index')
            .then(response => {
                    commit('SET_COUNCILS', response.data);
                }
            );
    },


};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
