const state = {
    user: {},
    organization: {},
    horizontalMenu: [],
    verticalMenu: [],
};
const getters = {
    organization: (state) => {
        return state.organization;
    },
    menuActive: (state) => (id) => {
        return state.organization?.menus?.menuActive.find(
            (item) => item.id == id
        );
    },
    menuActiveCount: (state) => {
        return state.organization?.menus?.paidmodules.filter(
            (item) => item.active == true
        ).length;
    },
    // horizontalMenu: state => {
    //     return state.organization?.menus?.horizontal
    // },
    // verticalMenu: state => {
    //     return state.organization?.menus?.vertical
    // },
    paidmodules: (state) => {
        return state.organization?.menus?.paidmodules;
    },
    paidmodulesCount: (state) => {
        return state.organization?.menus?.paidmodules.length;
    },
    orgPosts: (state) => {
        return state.organization?.posts?.years_of_posts;
    },
    userAdmin: (state) => {
        return state.user?.roles?.find((o) => o.name == "admin");
    },
};

const mutations = {
    SET_ORGANIZATION: function (state, payload) {
        state.user = payload.data;
        state.organization = payload.data.organization;
        state.horizontalMenu = payload.data.organization.menus.horizontal;
        state.verticalMenu = payload.data.organization.menus.vertical;
    },
};
const actions = {
    getOrganization({ commit }) {
        axios.get("/api/user").then((response) => {
            commit("SET_ORGANIZATION", response.data);
        });
    },

    updateOrganization: function ({ commit, dispatch }, organization) {
        axios
            .put("/api/organizations/" + organization.id + "/", organization)
            .then((response) => {
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
