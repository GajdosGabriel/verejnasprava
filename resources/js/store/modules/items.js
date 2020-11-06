const state = {
    interpellations: [],
    item: '',
    votes: [],
    user: ''
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
        state.user = item.user;
        state.votes = item.votes;
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
    getItem({commit}, item) {
        axios.get('/api/items/' + item )
            .then(response => {
                commit('SET_ITEM', response.data );
            });
    },

    storeVote({commit, dispatch}, item) {
        axios.put('/api/vote/' + item.id, item)
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id, {root:true});
                commit('SET_ITEM', response.data );
            });

    },

    update({commit, dispatch}, item) {
        axios.put('/api/items/' + item.id, item)
            .then(response => {
                // console.log(response.headers.notification);
                commit('SET_ITEM', response.data);
                // dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});

                // Notify for add task
                dispatch('notification/addNewNotification', { message: response.headers.notification, type: 'bg-green-400' }, { root: true}
                )
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
