const state = {
    items: [],
    votes: [],
    userVote: null,
    interpellations: [],
    item: '',
    authUser: ''
};

const getters = {
    get_votes: (state) => {
        return state.item.votes.filter(todo => todo.item_id == 1)
    }

};

const mutations = {

    SET_AUTH_USER: function (state, user) {
        state.authUser = user;
    },

    SET_ITEM: function (state, item) {
        state.item = item;
        // state.votes = item.user;
        // state.interpellations = item.interpellations;
        // state.votes = item.votes;
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
    set_item({commit}, meeting) {
        console.log(meeting);
        commit('SET_ITEM', meeting)
    },

    get_item({commit}, itemId) {

        axios.get('/api/item/' + itemId + '/show')
            .then(response => {
                commit('SET_ITEM', response.data );
            });
    },

    set_vote_status({commit, dispatch}, item) {
        if (!item.published) {
            alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
            return
        }

        if (item.interpellations.length) {
            alert('Zoznam prihlásených do rozpravy nie je prázdny.');
            return
        }

        axios.get('/api/item/' + item.id + '/voteStatus')
            .then(response => {
                dispatch('meetings/fetchMeeting', item.meeting_id, {root:true});
            });
    },

    publishedToggle({commit, dispatch}, item) {
        if (item.vote_status){
            alert('Hlasovanie sa už začalo, prihlasovanie je zrušené!');
           return
        }
      axios.get('/api/item/' + item.id + '/published')
          .then(response => {
              dispatch('meetings/fetchMeeting', item.meeting_id, {root:true});
          });
    },


    storeVote({commit, dispatch}, payload) {
        axios.put('/api/vote/' + payload.id, payload)
            .then(response => {
                dispatch('meetings/fetchMeeting', payload.meetingId, {root:true})
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
