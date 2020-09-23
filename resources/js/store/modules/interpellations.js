const state = {
    loadingStatus: 'notLoading',
    interpellations: []
};
const getters = {};

const mutations = {
    SET_INTERPELLATION: function (state, data) {
        state.interpellations = data
    }
};

const actions = {
    saveInterpellation({commit}, payload) {
        axios.get('/inter/' + payload.id + '/' + payload.slug + '/item/interpellation')
            .then(response => {
              commit('SET_INTERPELLATION', response.data )
            });
    }

};


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
