const state = {
    loadingStatus: 'notLoading',
    meeting: '',
    items: [],
};
const getters = {};

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
        commit('SET_LOADING_STATUS', 'loading');
        axios.get('/api/item/' + meetingId + '/dfsad/index' )
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
