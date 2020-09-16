const state = {
    items: []

};
const getters = {
};

const mutations = {
    SET_ITEMS: function (state, meeting) {
        state.items = meeting.items;
    },

    SET_VOTE_STATUS: function (state, item) {
        item.vote_status = !item.vote_status;
    }



};
const actions = {
    set_items({commit}, meeting) {
        commit('SET_ITEMS', meeting)
    },

    get_item({commit}, item) {
        commit('GET_ITEM', item)
    },

    set_vote_status({commit}, item) {
        axios.put('/api/item/' + item.id);
        commit('SET_VOTE_STATUS', item);
    },

    publishedToggle({commit}, item) {
     axios.get('/api/item/' + item.id + '/published');

    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
