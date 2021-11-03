const state = {
    user: {},
    organization: {},
    menuActive: [],
    horizontalMenu: [],
    verticalMenu: [],
    paidmodules: [],
    orgPosts: [],
};
const getters = {};

const mutations = {

    SET_ORGANIZATION: function (state, payload) {
        state.user = payload.data;
        state.organization = payload.data.organization;
        state.menuActive = payload.data.organization.menus.menuActive;
        state.horizontalMenu = payload.data.organization.menus.horizontal;
        state.verticalMenu = payload.data.organization.menus.menuActive.vertical;
        state.paidmodules = payload.data.organization.menus.paidmodules;
        state.orgPosts = payload.data.organization.posts;
    },

};
const actions = {

    getOrganization({commit}) {
        axios.get('/api/user')
            .then(response => {
                    commit('SET_ORGANIZATION', response.data);
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
