const state = {
    meeting:'',
    items:[],
    loadingStatus: false
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
        state.items = meeting.items;
    }
};
const actions = {

    fetchMeeting({commit}, meetingId) {
        commit('SET_LOADING_STATUS', true);
        axios.get('/api/meeting/' + meetingId + '/show' )
            .then(response => {
                    commit('SET_MEETING', response.data);
                    commit('SET_LOADING_STATUS', false);
                }
            );
    },

    update({commit}, meeting){
        commit('SET_LOADING_STATUS', true);

        axios.put('/api/meeting/' + meeting.id, meeting)
            .then(response => {
                    // commit('SET_ITEMS', response.data);
                    commit('SET_LOADING_STATUS', false);
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
