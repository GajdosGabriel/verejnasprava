const state = {
    loadingStatus: 'notLoading',
    contacts: [],
    showEditForm: false,
    showCreateForm: false,
    url: '/api/contacts/',
    contact: {}
};
const getters = {};

const mutations = {
    SET_LOADING_STATUS: function (state, status) {
        state.loadingStatus = status
    },
    SET_CONTACTS: function (state, contacts) {
        state.contacts = contacts;
    },

    INSERT_CONTACT: function (state, contact) {
        state.contacts.data.unshift(contact);
    },
    SHOW_FORM: function (state, data) {
        state.showEditForm = !state.showEditForm;
        state.contact = data
    },

    SHOW_NEW_FORM: function (state, data) {
        state.showCreateForm = !state.showCreateForm;
        state.contact = data
    },
    REMOVE_CONTACT: function (state, id) {
        state.contacts = state.contacts.data.filter(
            contact => contact.id !== id
        )
    }

};
const actions = {
    openEditForm({commit}, data) {
        commit('SHOW_FORM', data)
    },

    newContactToggle({commit}, data) {
        commit('SHOW_NEW_FORM', data)
    },

    insert_contact({commit}, data) {
        commit('INSERT_CONTACT', data)
    },

    async deleteContact({commit}, id) {
        await axios.delete('/api/contacts/' + id);

        commit('REMOVE_CONTACT', id);
        commit('SHOW_FORM');

        commit('notification/NEW_NOTIFICATION', {
            type: 'bg-green-400',
            message: 'Kontakt zmazaný!'
        }, {root: true});
    },

    async updateContact({commit}, contact) {
        await axios.patch('/contact/update/' + contact.id, contact);

        commit('SHOW_FORM');

        // Notify for add task
        commit('notification/NEW_NOTIFICATION', {
            type: 'bg-green-400',
            message: 'Kontakt uložený!'
        }, {root: true})

    },

    async saveContact({commit}, organizationId, data) {
        await axios.post('/contact/store/' + organizationId, data);

        // commit('SHOW_FORM');

        // Notify for add task
        commit('notification/NEW_NOTIFICATION', {
            type: 'bg-green-400',
            message: 'Kontakt uložený!'
        }, {root: true})

    },

    fetchContacts(context, url) {
        context.commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                    context.commit('SET_LOADING_STATUS', 'notLoading');
                    context.commit('SET_CONTACTS', response.data);
                }
            );
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
