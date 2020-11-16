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
        axios.get('/organizations/' + payload + '/councils')
            .then(response => {
                    commit('SET_COUNCILS', response.data);
                }
            );
    },

    update({commit}, payload) {
        console.log(payload);
        axios.put('/api/councils/' + payload.id, payload)
            .then(response => {
                commit('modals/OPEN_FORM', null, {root: true} );
                }
            );
    },

    deleteCouncil({commit}, council) {
        axios.delete('/api/councils/' + council.id)
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
