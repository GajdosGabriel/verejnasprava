const state = {
    items: [],
    votes: [],
    interpellations: [],
    item: '',
    userVote: null,
    authUser: ''

};
const getters = {

};

const mutations = {

    SET_AUTH_USER: function (state, user) {
        state.authUser = user;
    },


    SET_ITEMS: function (state, meeting) {
        state.items = meeting.items;
    },

    SET_ITEM: function (state, item) {
        state.item = item;
        state.votes = item.votes;
        state.interpellations = item.interpellations;
        state.userVote = state.votes.find(vote => vote.user_id === state.authUser.id);
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
    set_items({commit}, meeting) {
        commit('SET_ITEMS', meeting)
    },

    get_item({commit}, itemId) {

        axios.get('/api/item/' + itemId + '/show')
            .then(response => {
                commit('SET_ITEM', response.data );
            });
    },

    set_vote_status({commit, dispatch}, item) {
        if (state.item.published) {
            alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
            return
        }

        if (state.interpellations.length) {
            alert('Zoznam prihlásených do rozpravy nie je prázdny.');
            return
        }

        axios.get('/api/item/' + item.id + '/voteStatus')
            .then(response => {
                dispatch('meetings/fetchMeeting', item.meeting_id, {root:true});
            });
    },

    publishedToggle({commit, dispatch}, item) {
        if (state.votes.length > 0){
            alert('Hlasovanie sa už začalo, nie je možné zrušiť publikovanie!');
           return
        }
      axios.get('/api/item/' + item.id + '/published')
          .then(response => {
              dispatch('meetings/fetchMeeting', item.meeting_id, {root:true});
          });
    },


    saveInterpellation({commit, dispatch}, payload) {
        axios.get('/inter/' + payload.id + '/' + payload.slug + '/item/interpellation')
            .then(response => {
                // commit('SET_INTERPELLATIONS', response.data )
                dispatch('meetings/fetchMeeting', payload.meeting_id, {root:true})
            });
    },

    storeVote({commit, dispatch}, payload) {
        console.log(payload);
        axios.put('/api/vote/' + payload.id, payload)
            .then(response => {
                dispatch('meetings/fetchMeeting', payload.meetingId, {root:true})
            });

    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
