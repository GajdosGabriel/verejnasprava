const state = {
    interpellations: [],
    votes: [],
    files: [],
    item: '',
    user: ''
};

const getters = {

    resultYes:(state) => {
        return state.item.votes
    },

    // get_votes: (state) => {
    //     return state.votes.find(todo => todo.user_id == 1)
    // }

};

const mutations = {
    SET_ITEM: function (state, item) {
        state.item = item;
        state.user = item.user;
        state.votes = item.votes;
        state.files = item.files;
        state.interpellations = item.interpellations;
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
        axios.put('/api/votes/' + item.id, item)
            .then(response => {
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

    updateInterpellation({commit, dispatch}, item) {
        if (item.vote_status){
            alert('Hlasovanie sa už začalo, interpelácie sú zastavené!');
            return
        }
        axios.put('/interpellations/' + item.id )
            .then(response => {
                dispatch('items/getItem', item.id, {root:true});
            });
    },

    deleteInterpellation({commit, dispatch}, id) {
        axios.delete('/interpellations/' + id)
            .then(response => {
                dispatch('items/getItem', this.state.items.item.id, {root:true});
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
