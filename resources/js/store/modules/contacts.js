const state = {
    loadingStatus: "notLoading",
    contacts: [],
    errors: [],
    showEditForm: false,
    showCreateForm: false,
    contact: "",
};
const getters = {};

const mutations = {
    SET_LOADING_STATUS: function (state, payload) {
        state.loadingStatus = payload;
    },
    SET_CONTACTS: function (state, payload) {
        state.contacts = payload;
    },
    SET_CONTACT: function (state, payload) {
        state.contact = payload;
    },
    SET_ERRORS: function (state, payload) {
        state.errors = payload;
    },

    INSERT_CONTACT: function (state, payload) {
        state.contacts.unshift(payload);
    },
    SHOW_FORM: function (state, payload) {
        state.showEditForm = !state.showEditForm;
        state.contact = payload;
    },
    SHOW_CREATE_FORM: function (state, payload) {
        state.showCreateForm = !state.showCreateForm;
        state.contact = payload;
    },

    SHOW_NEW_FORM: function (state, payload) {
        state.showCreateForm = !state.showCreateForm;
        state.contact = payload;
    },
    REMOVE_CONTACT: function (state, id) {
        state.contacts.data = state.contacts.filter(
            (contact) => contact.id !== id
        );
    },
};
const actions = {
    openEditForm({ commit }, data) {
        commit("SHOW_FORM", data);
    },

    newContactToggle({ commit }, data) {
        commit("SHOW_NEW_FORM", data);
    },

   async deleteContact({ commit }, contact) {
    await axios
            .delete(contact.url.updateDelete)
            .then((response) => {
                console.log(response.data.data);
                commit("REMOVE_CONTACT", response.data.data.id),
                    commit("SHOW_FORM"),
                    commit(
                        "notification/NEW_NOTIFICATION",
                        {
                            type: "bg-green-300",
                            message: "Kontakt zmazaný!",
                        },
                        { root: true }
                    );
            })
            .catch((error) => {
                commit("SHOW_FORM"),
                    commit(
                        "notification/NEW_NOTIFICATION",
                        {
                            type: "bg-red-200",
                            message: "Kontakt už obsahuje zverejnené doklady.",
                        },
                        { root: true }
                    );
            });
    },

    async updateContact({ commit }, contact) {
        await axios
            .put(contact.url.updateDelete, contact)
            .then((response) => {
                commit("SHOW_FORM");

                // Notify for add task
                commit(
                    "notification/NEW_NOTIFICATION",
                    {
                        type: "bg-green-400",
                        message: "Kontakt aktualizovaný!",
                    },
                    { root: true }
                );
            })
            .catch((error) => {
                // Notify for add task
                commit(
                    "notification/NEW_NOTIFICATION",
                    {
                        type: "bg-red-400",
                        message: "Chyba, kontakt nebol aktualizovaný!",
                    },
                    { root: true }
                );

                commit("SET_ERRORS", error.response.data.errors);

                // console.log(error.response.data)
            });
    },

    async saveContact({ commit }, [data, user]) {
        await axios
            .post(
                "/api/organizations/" + user.active_organization + "/contacts",
                data
            )
            .then((response) => {
                commit("SHOW_CREATE_FORM"),
                    commit("INSERT_CONTACT", response.data.data),
                    // Notify for add task
                    commit(
                        "notification/NEW_NOTIFICATION",
                        {
                            type: "bg-green-400",
                            message: "Kontakt uložený!",
                        },
                        { root: true }
                    );
            });
    },

    fetchContacts({ commit }, url) {
        commit("SET_LOADING_STATUS", "loading");
        axios.get(url).then((response) => {
            commit("SET_LOADING_STATUS", "notLoading");
            commit("SET_CONTACTS", response.data);
        });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
