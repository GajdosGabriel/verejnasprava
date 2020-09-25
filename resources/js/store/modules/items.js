const state = {
    items: [],
    votes: [],
    interpellations: [],
    item: '',
    userVote: null,
    authUser: ''

};
const getters = {
    // meVote:  state => {
    // return state.votes.find(todo => todo.user_id === state.authUser.id)
// }

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

    SET_VOTE_STATUS: function (state) {
        state.item.vote_status = ! state.item.vote_status;
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

    set_vote_status({commit}, item) {
        if (! state.item.published) {
            alert('Bod programu nie je publikovaný. Zapnite publikovanie!');
            return
        }

        if (state.interpellations.length) {
            alert('Zoznam prihlásených do rozpravy nie je prázdny.');
            return
        }

        axios.get('/api/item/' + item.id + '/voteStatus');
        commit('SET_VOTE_STATUS');
    },

    publishedToggle({commit}, item) {
        if (state.votes.length > 0){
            alert('Hlasovanie sa už začalo, položku nie je možné zrušiť publikovanie!');
           return
        }
      axios.get('/api/item/' + item.id + '/published')
          .then(response => {
              commit('SET_ITEM', response.data );

              // if (state.item.vote_status) {
              //     commit('SET_VOTE_STATUS');
              // }
          });
    },


    saveInterpellation({commit}, payload) {
        axios.get('/inter/' + payload.id + '/' + payload.slug + '/item/interpellation')
            .then(response => {
                commit('SET_INTERPELLATIONS', response.data )
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
