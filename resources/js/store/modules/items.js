const state = {
    items: [],
    votes:[],
    interpellations:[],
    item: ''

};
const getters = {
    getItemById: (state) => (id) => state.items.find(i => i.id === id),
};

const mutations = {
    SET_ITEMS: function (state, meeting) {
        state.items = meeting.items;
    },

    SET_ITEM: function (state, item) {
        state.item = item;
    },

    SET_VOTES: function (state, item) {
        state.votes = item;
    },

    SET_INTERPELLATIONS: function (state, item) {
        state.interpellations = item;
    },

    SET_VOTE_STATUS: function (state, item) {
        item.vote_status = !item.vote_status;
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
                commit('SET_VOTES', response.data.votes );
                commit('SET_INTERPELLATIONS', response.data.interpellations );
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
        commit('SET_VOTE_STATUS', item);
    },

    publishedToggle({commit}, item) {
      axios.get('/api/item/' + item.id + '/published');
        commit('PUBLISHED_STATUS', item);
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
