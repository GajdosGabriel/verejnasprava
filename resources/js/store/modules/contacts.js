const state = {
    loadingStatus: 'notLoading',
    contacts: [],
    showEditForm: false,
    showCreateForm: false
};
const getters = {};

const mutations = {
    SET_LOADING_STATUS: function (state, status) {
        state.loadingStatus = status
    },
    SET_CONTACTS: function (state, contacts) {
        state.contacts = contacts;
    },
    SHOW_FORM: function(state, data){
        state.showEditForm =! state.showEditForm;
        state.contact = data
    },

    SHOW_NEW_FORM: function(state, data){
        state.showCreateForm =! state.showCreateForm;
        state.contact = data
    }

};
const actions = {
    fetchContacts(context, url) {
        context.commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                    context.commit('SET_LOADING_STATUS', 'notLoading');
                    context.commit('SET_CONTACTS', response.data);
                }
            );
    },

    openEditForm({commit}, data){
        commit('SHOW_FORM', data)
    },

    newContactToggle({commit}, data){
        commit('SHOW_NEW_FORM', data)
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
