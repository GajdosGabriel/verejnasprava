const state = {
    interpellations: [],
    item: ''
};

const getters = {

    resultYes:(state) => {
        return state.item.votes
    },

    // get_votes: (state) => {
    //     return state.item.votes.filter(todo => todo.item_id == 1)
    // }

};

const mutations = {
    SET_ITEM: function (state, item) {
        state.item = item;
        // state.meetingId = item.pivot.meeting_id;
        // state.interpellations = item.interpellations;
    },

    SET_VOTES: function (state, item) {
        state.votes = item;
    },

    SET_INTERPELLATIONS: function (state, item) {
        state.interpellations = item;
    },
    PUBLISHED_STATUS: function (state, item) {
        item.published = !item.published;
    }

};
const actions = {
    getItem({commit}, itemId) {
        axios.get('/api/item/' + itemId +'/show')
            .then(response => {
                commit('SET_ITEM', response.data );
            });
    },

    storeVote({commit, dispatch}, item) {
        axios.put('/api/vote/' + item.id, item)
            .then(response => {
                dispatch('meetings/fetchMeeting', item.meetingId, {root:true});
                commit('SET_ITEM', response.data );
            });

    },

    update({commit, dispatch}, item) {
        axios.put('/api/item/' + item.id + '/update', item)
            .then(response => {
                commit('SET_ITEM', response.data);
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id, {root:true});
            });
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
