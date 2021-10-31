const state = {
    organization: {},
    // menus: [],
    // active: [],
    // yearsOfPosts: []

};
const getters = {};

const mutations = {

    SET_ORGANIZATION: function (state, payload) {
        state.organization = payload.data;
        // state.menus = payload.data.menus;
        // state.active = payload.data[1].menus;
        // state.yearsOfPosts = payload.data.yearsOfPosts;
    },

};
const actions = {

    getOrganization({commit}, url) {
        axios.get(url)
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
