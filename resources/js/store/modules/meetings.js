const state = {
    loadingStatus: 'notLoading',
    items: [],
    authUser: ''
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
    },
    SET_AUTHUSER: function (state, payload) {
        state.authUser = payload;
    },
};
const actions = {

    fetchMeeting({commit}, meetingId) {
        commit('SET_LOADING_STATUS', 'loading');
        axios.get('/api/meeting/' + meetingId + '/show' )
            .then(response => {
                    commit('SET_LOADING_STATUS', 'notLoading');
                    commit('SET_ITEMS', response.data);
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
