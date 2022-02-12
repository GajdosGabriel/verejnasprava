const state = {
    user: {},
};
const getters = {};

const mutations = {
    SET_USER: function (state, payload) {
        state.user = payload;
    },
};
const actions = {
    getUser({ commit }) {
        axios.get("/api/user").then((response) => {
            commit("SET_USER", response.data);
        });
    },

    updateUser: function ({ commit, dispatch }, user) {
        axios.put("/api/users/" + user.id + "/", user).then((response) => {
            commit("SET_USER", response.data);

            // Notify for update user
            dispatch(
                "notification/addNewNotification",
                {
                    message: "Údaje boli aktualizované.",
                    type: "bg-green-400",
                },
                { root: true }
            );
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
