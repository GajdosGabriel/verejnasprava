const state = {
    councils: [],
    council: "",
};
const getters = {};

const mutations = {
    SET_COUNCILS: function (state, payload) {
        state.councils = payload;
    },

    SET_COUNCIL: function (state, payload) {
        state.council = payload;
    },

    REMOVE_COUNCIL: function (state, id) {
        var index = state.councils.findIndex((council) => council.id == id);
        state.councils.splice(index, 1);
    },
};
const actions = {
    fetchCouncils({ commit }, organizationId) {
        axios
            .get("/organizations/" + organizationId + "/councils")
            .then((response) => {
                commit("SET_COUNCILS", response.data);
            });
    },

    storeCouncil({ commit, dispatch }, [orgId, form2]) {
        axios
            .post("/api/organizations/" + orgId + "/councils", form2)
            .then((response) => {
                commit("SET_COUNCILS", response.data);

                // Notify for create council
                dispatch(
                    "notification/addNewNotification",
                    {
                        message: "Zastupiteľstvo bolo uložené.",
                        type: "bg-green-400",
                    },
                    { root: true }
                );
            });
    },

    updateCouncil({ commit, dispatch }, payload) {
        console.log(payload);
        axios
            .put(
                "/api/organizations/" +
                    payload.organization_id +
                    "/councils/" +
                    payload.id,
                payload
            )
            .then((response) => {
                commit("modals/OPEN_FORM", null, { root: true });

                // Notify for update council
                dispatch(
                    "notification/addNewNotification",
                    {
                        message: "Zastupiteľstvo bolo aktualizované.",
                        type: "bg-green-400",
                    },
                    { root: true }
                );

            });
    },

    deleteCouncil({ commit, dispatch }, council) {
        axios
            .delete(
                "/api/organizations/" +
                    council.organization_id +
                    "/councils/" +
                    council.id
            )
            .then((response) => {
                commit("REMOVE_COUNCIL", council.id);

                commit("modals/OPEN_FORM", null, { root: true });

                // Notify for Delete council
                dispatch(
                    "notification/addNewNotification",
                    {
                        message: "Zastupiteľstvo bolo zmazané.",
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
