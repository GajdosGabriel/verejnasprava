const state = {
    meeting:'',
    items:[],
    meetingUsers:[],
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
        state.meetingUsers = meeting.users;
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
                    commit('SET_MEETING', response.data);
                    commit('SET_LOADING_STATUS', false);

                    // dispatch('notification/addNewNotification', { message: response.data, type: 'bg-green-400' }, { root: true})
                }
            );

    },

    updateItem({commit, dispatch}, item) {
        axios.put('/api/items/' + item.id, item)
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});

                // Notify for add task
                dispatch('notification/addNewNotification', { message: response.headers.notification, type: 'bg-green-400' }, { root: true}
                )
            });
    },

    updateInterpellation({commit, dispatch}, item) {
        axios.put('/interpellations/' + item.id )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
            });
    },

    deleteInterpellation({commit, dispatch}, item) {
        axios.delete('/interpellations/' + item.id )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
            });
    },

    storeMeetingUser({commit, dispatch}, meeting) {
        axios.post('/meetingUsers', meeting )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
            });
    },

    updateMeetingUser({commit, dispatch}, meeting) {
        axios.put('/meetingUsers/' + meeting.id, meeting )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
            });
    },

    deleteMeetingUser({commit, dispatch}, meeting) {
        console.log(meeting);
        axios.delete('/meetingUsers/' + meeting.id )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
            });
    },

    deleteItemMeeting({commit, dispatch}, item) {
        axios.delete('/meetings/'+ this.state.meetings.meeting.id + '/items/' + item.id )
            .then(response => {
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id,  {root:true});
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
