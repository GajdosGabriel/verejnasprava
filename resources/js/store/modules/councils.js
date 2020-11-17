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
    },

    REMOVE_COUNCIL: function(state, id) {
       var index = state.councils.findIndex(council => council.id == id);
        state.councils.splice(index, 1)
    }


};
const actions = {
    fetchCouncils({commit}, organizationId) {
        axios.get('/organizations/' + organizationId + '/councils')
            .then(response => {
                    commit('SET_COUNCILS', response.data);
                }
            );
    },

    update({commit}, payload) {
        axios.put('/api/councils/' + payload.id, payload)
            .then(response => {
                commit('modals/OPEN_FORM', null, {root: true} );
                }
            );
    },

    deleteCouncil({commit}, council) {
        axios.delete('/api/councils/' + council.id)
            .then(response => {
                    commit('REMOVE_COUNCIL', council.id);
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
