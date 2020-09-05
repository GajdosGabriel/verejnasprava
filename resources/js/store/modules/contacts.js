const state = {
    contacts: []
};
const getters = {};

const mutations = {
    SET_CONTACTS: function (state, contacts) {
        state.contacts = contacts;
    }

};
const actions = {
    loadContacts({commit}, url) {
        axios.get(url)
            .then(response => {
                    commit('SET_CONTACTS', response.data.data)
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
