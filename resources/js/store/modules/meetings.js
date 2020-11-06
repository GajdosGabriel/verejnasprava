const state = {
    meeting:'',
    items:[],
    loadingStatus: false,
    positionActive: false
};
const getters = {
    activeItem: (state) => (id) => {
        return state.items.find(todo => todo.id === id)
    },
    allItem: (state) => {
        return state.items
    },
    publishedItem: (state) => {
        return state.items.filter(todo => todo.published == 1)
    }
};

const mutations = {
    SET_LOADING_STATUS: function (state, payload) {
        state.loadingStatus = payload
    },
    SET_MEETING: function (state, meeting) {
        state.meeting = meeting;
        state.items = meeting.items.sort((a, b) => a.position > b.position ? 1: -1);
    },
    UPDATE_LIST: function (state, payload) {
        state.items = payload
    },
    POSITION_ACTIVE: (state, payload) => {
        state.positionActive = payload
    }
};
const actions = {

    fetchMeeting({commit}, meeting) {
        commit('SET_LOADING_STATUS', true);
        axios.get('/api/meetings/' + meeting )
            .then(response => {
                    commit('SET_MEETING', response.data);
                    commit('SET_LOADING_STATUS', false);
                }
            );
    },

    update({commit, dispatch}, meeting){
        commit('SET_LOADING_STATUS', true);
        axios.put('/api/meetings/' + meeting.id, meeting)
            .then(response => {
                    // commit('SET_ITEMS', response.data);
                    commit('SET_LOADING_STATUS', false);

                    dispatch('notification/addNewNotification', { message: response.data, type: 'bg-green-400' }, { root: true})
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
