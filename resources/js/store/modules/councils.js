const state = {
    councils: [],
    council: ''
};
const getters = {};

const mutations = {
    SET_COUNCILS: function(state, payload) {
        state.councils = payload
    },

    SET_COUNCIL: function(state, payload) {
        state.council = payload
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

    update({commit}, payload) {
        console.log(payload);
        axios.put('/api/councils/' + payload.id + '/update', payload)
            .then(response => {
                commit('modals/OPEN_FORM', null, {root: true} );
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
