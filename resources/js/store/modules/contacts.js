const state = {
    loadingStatus: 'notLoading',
    contacts: [],
    showEditForm: false,
    showCreateForm: false,
    url: '/api/contacts/',
    contact: ''
};
const getters = {};

const mutations = {
    SET_LOADING_STATUS: function (state, payload) {
        state.loadingStatus = payload
    },
    SET_CONTACTS: function (state, payload) {
        state.contacts = payload;
    },

    INSERT_CONTACT: function (state, payload) {
        state.contacts.data.unshift(payload);
    },
    SHOW_FORM: function (state, payload) {
        state.showEditForm = !state.showEditForm;
        state.contact = payload
    },
    SHOW_CREATE_FORM: function (state, payload) {
        state.showCreateForm = !state.showCreateForm;
        state.contact = payload
    },

    SHOW_NEW_FORM: function (state, payload) {
        state.showCreateForm = !state.showCreateForm;
        state.contact = payload
    },
    REMOVE_CONTACT: function (state, id) {
        state.contacts.data = state.contacts.data.filter(
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
        await axios.put('/contacts/' + contact.id, contact);

        commit('SHOW_FORM');

        // Notify for add task
        commit('notification/NEW_NOTIFICATION', {
            type: 'bg-green-400',
            message: 'Kontakt uložený!'
        }, {root: true})

    },

    async saveContact({commit}, data) {
        await axios.post('/contacts', data);

        commit('SHOW_CREATE_FORM');
        commit('INSERT_CONTACT', data);

        // Notify for add task
        commit('notification/NEW_NOTIFICATION', {
            type: 'bg-green-400',
            message: 'Kontakt uložený!'
        }, {root: true})

    },

    fetchContacts({commit}, url) {
        commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                    commit('SET_LOADING_STATUS', 'notLoading');
                    commit('SET_CONTACTS', response.data);
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
