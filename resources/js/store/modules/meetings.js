const state = {
    loadingStatus: false,
    items: []
};
const getters = {
    activeItem: (state) => (id) => {
        return state.items.find(todo => todo.id === id)
    }
};

const mutations = {
    SET_LOADING_STATUS: function (state, payload) {
        state.loadingStatus = payload
    },
    SET_ITEMS: function (state, payload) {
        state.items = payload;
    }
};
const actions = {

    fetchMeeting({commit}, meetingId) {
        commit('SET_LOADING_STATUS', true);
        axios.get('/api/meeting/' + meetingId + '/show' )
            .then(response => {
                    commit('SET_ITEMS', response.data);
                    commit('SET_LOADING_STATUS', false);
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
