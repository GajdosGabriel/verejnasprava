const state = {
    loadingStatus: 'notLoading',
    contacts: []
};
const getters = {
    noPhone: function (state) {
        return state.contacts.filter(contact => {
            return contact.phone == null;
        })
    }
};

const mutations = {
    SET_LOADING_STATUS: function (state, status) {
        state.loadingStatus = status
    },
    SET_CONTACTS: function (state, contacts) {
        state.contacts = contacts;
    }

};
const actions = {
    fetchContacts(context, url) {
        context.commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                    context.commit('SET_LOADING_STATUS', 'notLoading');
                    context.commit('SET_CONTACTS', response.data.data);
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
